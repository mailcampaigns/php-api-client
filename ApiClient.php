<?php

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Component\HttpClient\HttpClient;
use MailCampaigns\ApiClient\Api\CustomerApi;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ApiClient
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var string
     */
    private $shopName;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var CustomerApi
     */
    public $customers;

    private function __construct(string $name, string $baseUri, string $key, string $secret)
    {
        $this->shopName = $name;
        $bearerToken = $this->getBearerToken($baseUri, $key, $secret);

        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'MailCampaigns API client', // todo: add version
                'X-MailCampaigns-ShopName' => $this->shopName
            ],
            'auth_bearer' => $bearerToken,
            'base_uri' => $baseUri
        ]);

        $this->customers = new CustomerApi($this);
    }

    public static function create(string $name, string $baseUri, string $key, string $secret): self
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($name, $baseUri, $key, $secret);
        }

        return self::$instance;
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return ApiClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * todo: improve
     *
     * @param string $baseUri
     * @param string $key
     * @param string $secret
     * @return string
     */
    private function getBearerToken(string $baseUri, string $key, string $secret): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $baseUri . "/oauth/v2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['scope' => '', 'grant_type' => 'client_credentials'],
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic " . base64_encode($key . ':' . $secret)
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $accessToken = json_decode($response);

        if (!$accessToken) {
            throw new ApiException('Invalid token data!');
        }

        return $accessToken->access_token;
    }
}
