<?php

use MailCampaigns\ApiClient\ApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;

class ApiClientTest extends TestCase
{
    protected $apiClient;

    public function setUp(): void
    {
        $this->apiClient = (new ReflectionClass(ApiClient::class))->newInstanceWithoutConstructor();
    }

    public function testGetHttpClient()
    {
        $httpClient = new MockHttpClient();
        $this->apiClient->setHttpClient($httpClient);
        $this->assertSame($httpClient, $this->apiClient->getHttpClient());
    }
}
