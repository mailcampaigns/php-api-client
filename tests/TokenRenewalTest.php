<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use MailCampaigns\ApiClient\Api\QuoteApi;
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\Entity\Quote;
use MailCampaigns\ApiClient\Exception\ApiAuthenticationException;
use MailCampaigns\ApiClient\Exception\ApiException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\MockHttpClient;

final class TokenRenewalTest extends TestCase
{
    private $server;
    private string $directory;
    private string $baseUri;
    private ApiClient $client;

    protected function setUp(): void
    {
        $socket = stream_socket_server('tcp://127.0.0.1:0', $error, $message);
        self::assertIsResource($socket, $message);
        $address = stream_socket_get_name($socket, false);
        fclose($socket);
        $this->baseUri = 'http://' . $address;
        $this->directory = sys_get_temp_dir() . '/api-client-test-' . bin2hex(random_bytes(8));
        mkdir($this->directory);
        $this->saveState(['tokens' => 0, 'requests' => []]);

        $this->server = proc_open(
            [PHP_BINARY, '-S', $address, __DIR__ . '/fixtures/oauth-router.php'],
            [0 => ['pipe', 'r'], 1 => ['file', $this->directory . '/server.log', 'a'],
                2 => ['file', $this->directory . '/server.log', 'a']],
            $pipes,
            $this->directory
        );
        self::assertIsResource($this->server);
        fclose($pipes[0]);
        for ($attempt = 0; $attempt < 100; ++$attempt) {
            $connection = @stream_socket_client('tcp://' . $address, $error, $message, 0.05);
            if ($connection !== false) {
                fclose($connection);
                break;
            }
            usleep(10000);
        }
        self::assertNotFalse($connection, 'Local OAuth fixture did not start');

        // Each case needs its own real client, independently of the public singleton.
        $constructor = new ReflectionMethod(ApiClient::class, '__construct');
        $constructor->setAccessible(true);
        $this->client = (new ReflectionClass(ApiClient::class))->newInstanceWithoutConstructor();
        $constructor->invoke($this->client, $this->baseUri, 'fixture-key', 'fixture-secret');
    }

    protected function tearDown(): void
    {
        if (is_resource($this->server)) {
            proc_terminate($this->server);
            proc_close($this->server);
        }
        if (!isset($this->directory)) {
            return;
        }
        foreach (glob($this->directory . '/*') as $file) {
            unlink($file);
        }
        rmdir($this->directory);
    }

    /** @dataProvider methods */
    public function testRejectedTokenIsRenewedOnceWithoutChangingTheRequest(string $method): void
    {
        $result = $this->request($method);
        self::assertSame($method === 'head' ? '' : ['ok' => true], $result);
        $state = $this->state();
        self::assertSame(2, $state['tokens']);
        self::assertCount(2, $state['requests']);
        $first = $state['requests'][0];
        $second = $state['requests'][1];
        self::assertSame('Bearer token-1', $first['authorization']);
        self::assertSame('Bearer token-2', $second['authorization']);
        unset($first['authorization'], $second['authorization']);
        self::assertSame($first, $second);
        self::assertSame(strtoupper($method), $second['method']);
        self::assertSame('preserved', $second['test_header']);
        if ($method === 'get' || $method === 'head') {
            self::assertSame('/resource?filter=unchanged', $second['uri']);
        } else {
            self::assertNotSame('', $second['body']);
        }

        // The renewed transport must also be retained for later API calls.
        $this->request($method);
        self::assertSame(2, $this->state()['tokens']);
        self::assertCount(3, $this->state()['requests']);
    }

    public static function methods(): array
    {
        return array_map(static function (string $method): array {
            return [$method];
        }, ['get', 'head', 'post', 'patch', 'put', 'delete']);
    }

    public function testSecondUnauthorizedResponseStillFails(): void
    {
        try {
            $this->request('get', '/always-unauthorized');
            self::fail('A persistent authentication failure must remain visible');
        } catch (ApiException $exception) {
            self::assertStringContainsString('401', $exception->getMessage());
        }
        self::assertSame(2, $this->state()['tokens']);
        self::assertCount(2, $this->state()['requests']);
    }

    /** @dataProvider nonAuthenticationFailures */
    public function testOtherFailuresAreNotReplayed(string $path, int $status): void
    {
        try {
            $this->request('post', $path);
            self::fail('API failures must remain visible');
        } catch (\Exception $exception) {
            self::assertStringContainsString((string)$status, $exception->getMessage());
        }
        self::assertSame(1, $this->state()['tokens']);
        self::assertCount(1, $this->state()['requests']);
    }

    public static function nonAuthenticationFailures(): array
    {
        return [['/forbidden', 403], ['/server-error', 500]];
    }

    public function testRefreshFailureDoesNotReplayTheRequest(): void
    {
        $state = $this->state();
        $state['reject_tokens'] = true;
        $this->saveState($state);
        try {
            $this->request('post');
            self::fail('Token endpoint failures must remain visible');
        } catch (ApiAuthenticationException $exception) {
            self::assertStringContainsString('invalid_client', $exception->getMessage());
        }
        self::assertSame(2, $this->state()['tokens']);
        self::assertCount(1, $this->state()['requests']);
    }

    public function testTransportFailureDoesNotRefreshOrReplay(): void
    {
        $attempts = 0;
        $httpClient = new MockHttpClient(static function () use (&$attempts) {
            ++$attempts;
            throw new TransportException('Fixture connection lost');
        });
        $this->client->setHttpClient($httpClient);
        try {
            $this->request('post');
            self::fail('A connection failure must not be replayed');
        } catch (TransportException $exception) {
            self::assertSame('Fixture connection lost', $exception->getMessage());
        }
        self::assertSame(1, $attempts);
        self::assertSame(1, $this->state()['tokens']);
    }

    public function testTokenIsRenewedBeforeExpiry(): void
    {
        $expiration = new ReflectionProperty(ApiClient::class, 'tokenExpirationDt');
        $expiration->setAccessible(true);
        $expiration->setValue($this->client, new DateTime('+30 seconds'));
        self::assertTrue($this->client->hasTokenExpired());
        self::assertSame(['ok' => true], $this->request('get'));
        self::assertSame(2, $this->state()['tokens']);
        self::assertCount(1, $this->state()['requests']);
        self::assertSame('Bearer token-2', $this->state()['requests'][0]['authorization']);
    }

    public function testFreshTokenIsNotRenewedEarly(): void
    {
        self::assertFalse($this->client->hasTokenExpired());
        self::assertSame(1, $this->state()['tokens']);
    }

    private function request(string $method, string $path = '/resource')
    {
        $api = new QuoteApi($this->client);
        $request = new ReflectionMethod($api, $method);
        $request->setAccessible(true);
        $parameters = ['filter' => 'unchanged'];
        $payload = in_array($method, ['post', 'patch', 'put'], true)
            ? (new Quote())->setQuoteRef('fixture-quote') : $parameters;

        return $request->invoke($api, $path, $payload, ['X-Test: preserved']);
    }

    private function state(): array
    {
        return json_decode(file_get_contents($this->directory . '/state.json'), true);
    }

    private function saveState(array $state): void
    {
        file_put_contents($this->directory . '/state.json', json_encode($state));
    }
}
