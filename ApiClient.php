<?php

namespace MailCampaigns\ApiClient;

use Symfony\Component\HttpClient\HttpClient;

final class ApiClient
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    private $httpClient;

    private function __construct($baseUri, $key, $secret)
    {
        $bearerToken = $this->getBearerToken($baseUri, $key, $secret);

        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'MailCampaigns API client' // todo: add version
            ],
            'auth_bearer' => $bearerToken,
            'base_uri' => $baseUri
        ]);

        $this->customers = new CustomerApi($this);
    }

    public static function create($baseUri, $key, $secret)
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($baseUri, $key, $secret);
        }

        return self::$instance;
    }

    /**
     * @return \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    public function getHttpClient(): \Symfony\Contracts\HttpClient\HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param \Symfony\Contracts\HttpClient\HttpClientInterface $httpClient
     */
    public function setHttpClient(\Symfony\Contracts\HttpClient\HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * todo: improve
     *
     * @return string
     */
    private function getBearerToken($baseUri, $key, $secret): string
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
            throw new Exception('Invalid token data!');
        }

        return $accessToken->access_token;
    }
}
