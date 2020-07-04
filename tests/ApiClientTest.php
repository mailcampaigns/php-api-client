<?php

use MailCampaigns\ApiClient\ApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class ApiClientTest extends TestCase
{
    protected $apiClient;

    public function setUp(): void
    {
        $this->apiClient = ApiClient::create('test', 'https://mailcampaigns.io', 'testkey', 'testsecret');
    }

    public function testGetHttpClient()
    {
        $this->assertInstanceOf(HttpClient::class, $this->apiClient->getHttpClient());
    }
}
