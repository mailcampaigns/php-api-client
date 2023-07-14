<?php

use MailCampaigns\ApiClient\ApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class ApiClientTest extends TestCase
{
    private ApiClient $apiClient;

    public function setUp(): void
    {
        $this->apiClient = ApiClient::create(
            'https://mailcampaigns.io',
            'testkey',
            'testsecret'
        );
    }

    public function testGetHttpClient()
    {
        $this->assertInstanceOf(
            HttpClient::class,
            $this->apiClient->getHttpClient()
        );
    }
}
