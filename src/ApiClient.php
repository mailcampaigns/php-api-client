<?php

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Api\CustomerApi;
use MailCampaigns\ApiClient\Api\OrderApi;
use MailCampaigns\ApiClient\Api\ProductApi;
use MailCampaigns\ApiClient\Api\QuoteApi;
use MailCampaigns\ApiClient\Exception\ApiAuthenticationException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ApiClient
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var CustomerApi
     */
    private $customerApi;

    /**
     * @var QuoteApi
     */
    private $quoteApi;

    /**
     * @var OrderApi
     */
    private $orderApi;

    /**
     * @var ProductApi
     */
    private $productApi;

    private function __construct(string $baseUri, string $key, string $secret)
    {
        // Get version from Composer configuration.
        $composerConfig = json_decode(file_get_contents(__DIR__ . '/../composer.json'));

        // Request an access token.
        $bearerToken = $this->getBearerToken($baseUri, $key, $secret);

        // Create an instance of the HTTP client.
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'MailCampaigns PHP API Client ' . $composerConfig->version
            ],
            'auth_bearer' => $bearerToken,
            'base_uri' => $baseUri
        ]);

        // Create API objects.
        $this->customerApi = new CustomerApi($this);
        $this->orderApi = new OrderApi($this);
        $this->quoteApi = new QuoteApi($this);
        $this->productApi = new ProductApi($this);
    }

    public function getCustomerApi(): CustomerApi
    {
        return $this->customerApi;
    }

    public function getOrderApi(): OrderApi
    {
        return $this->orderApi;
    }

    public function getQuoteApi(): QuoteApi
    {
        return $this->quoteApi;
    }

    public function getProductApi(): ProductApi
    {
        return $this->productApi;
    }

    public static function create(string $baseUri, string $key, string $secret): self
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($baseUri, $key, $secret);
        }

        return self::$instance;
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Retrieves access (bearer) token.
     *
     * @param string $baseUri
     * @param string $key
     * @param string $secret
     * @return string The access (bearer) token.
     */
    private function getBearerToken(string $baseUri, string $key, string $secret): string
    {
        $curl = curl_init();

        // Set Curl options.
        curl_setopt_array($curl, [
            CURLOPT_URL => $baseUri . '/oauth/v2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'scope' => 'read write',
                'grant_type' => 'client_credentials'
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($key . ':' . $secret)
            ]
        ]);

        $response = curl_exec($curl);

        if (false === $response) {
            throw new ApiAuthenticationException(sprintf('Failed to retrieve access token: `%s`.',
                curl_error($curl)), curl_errno($curl));
        }

        curl_close($curl);

        $decodedResponse = json_decode($response);

        if ($decodedResponse) {
            if (isset($decodedResponse->access_token)) {
                return $decodedResponse->access_token;
            }

            if (isset($decodedResponse->error)) {
                $error = $decodedResponse->error;
                $errorDescription = $decodedResponse->error_description ?? '(no error description)';

                throw new ApiAuthenticationException(sprintf('Failed to retrieve access token: [%s] %s.',
                    $error, $errorDescription));
            }
        }

        throw new ApiAuthenticationException('Could not retrieve access token! '
            . 'Received an unexpected response from the authentication server.');
    }
}
