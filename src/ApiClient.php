<?php

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Api\CustomerApi;
use MailCampaigns\ApiClient\Api\CustomerCustomFieldApi;
use MailCampaigns\ApiClient\Api\CustomerFavoriteProductApi;
use MailCampaigns\ApiClient\Api\OrderApi;
use MailCampaigns\ApiClient\Api\OrderCustomFieldApi;
use MailCampaigns\ApiClient\Api\OrderProductApi;
use MailCampaigns\ApiClient\Api\ProductApi;
use MailCampaigns\ApiClient\Api\ProductCategoryApi;
use MailCampaigns\ApiClient\Api\ProductCrossSellProductApi;
use MailCampaigns\ApiClient\Api\ProductCustomFieldApi;
use MailCampaigns\ApiClient\Api\ProductProductCategoryApi;
use MailCampaigns\ApiClient\Api\ProductRelatedProductApi;
use MailCampaigns\ApiClient\Api\ProductReviewApi;
use MailCampaigns\ApiClient\Api\ProductUpSellProductApi;
use MailCampaigns\ApiClient\Api\ProductVolumeSellProductApi;
use MailCampaigns\ApiClient\Api\QuoteApi;
use MailCampaigns\ApiClient\Api\QuoteProductApi;
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
     * @var QuoteProductApi
     */
    private $quoteProductApi;

    /**
     * @var OrderApi
     */
    private $orderApi;

    /**
     * @var OrderApi
     */
    private $orderProductApi;

    /**
     * @var ProductApi
     */
    private $productApi;

    /**
     * @var ProductCategoryApi
     */
    private $productCategoryApi;

    /**
     * @var ProductProductCategoryApi
     */
    private $productProductCategoryApi;

    /**
     * @var ProductReviewApi
     */
    private $productReviewApi;

    /**
     * @var CustomerFavoriteProductApi
     */
    private $customerFavoriteProductApi;

    /**
     * @var ProductRelatedProductApi
     */
    private $productRelatedProductApi;

    /**
     * @var ProductCrossSellProductApi
     */
    private $productCrossSellProductApi;

    /**
     * @var ProductUpSellProductApi
     */
    private $productUpSellProductApi;

    /**
     * @var ProductVolumeSellProductApi
     */
    private $productVolumeSellProductApi;

    /**
     * @var ProductCustomFieldApi
     */
    private $productCustomFieldApi;

    /**
     * @var CustomerCustomFieldApi
     */
    private $customerCustomFieldApi;

    /**
     * @var OrderCustomFieldApi
     */
    private $orderCustomFieldApi;

    private function __construct(string $baseUri, string $key, string $secret)
    {
        // Get version from Composer configuration.
        $composerConfig = json_decode(file_get_contents(__DIR__ . '/../composer.json'));

        // Request an access token.
        $bearerToken = $this->getBearerToken($baseUri, $key, $secret);

        // Create an instance of the HTTP client.
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'MailCampaigns PHP API client ' . $composerConfig->version
            ],
            'auth_bearer' => $bearerToken,
            'base_uri' => $baseUri
        ]);

        // Create API objects.
        $this->customerApi = new CustomerApi($this);
        $this->orderApi = new OrderApi($this);
        $this->orderProductApi = new OrderProductApi($this);
        $this->quoteApi = new QuoteApi($this);
        $this->quoteProductApi = new QuoteProductApi($this);
        $this->productApi = new ProductApi($this);
        $this->productCategoryApi = new ProductCategoryApi($this);
        $this->productProductCategoryApi = new ProductProductCategoryApi($this);
        $this->productReviewApi = new ProductReviewApi($this);
        $this->customerFavoriteProductApi = new CustomerFavoriteProductApi($this);
        $this->productRelatedProductApi = new ProductRelatedProductApi($this);
        $this->productCrossSellProductApi = new ProductCrossSellProductApi($this);
        $this->productUpSellProductApi = new ProductUpSellProductApi($this);
        $this->productVolumeSellProductApi = new ProductVolumeSellProductApi($this);
        $this->productCustomFieldApi = new ProductCustomFieldApi($this);
        $this->customerCustomFieldApi = new CustomerCustomFieldApi($this);
        $this->orderCustomFieldApi = new OrderCustomFieldApi($this);
    }

    public function getCustomerApi(): CustomerApi
    {
        return $this->customerApi;
    }

    public function getOrderApi(): OrderApi
    {
        return $this->orderApi;
    }

    public function getOrderProductApi(): OrderProductApi
    {
        return $this->orderProductApi;
    }

    public function getQuoteApi(): QuoteApi
    {
        return $this->quoteApi;
    }

    public function getQuoteProductApi(): QuoteProductApi
    {
        return $this->quoteProductApi;
    }

    public function getProductApi(): ProductApi
    {
        return $this->productApi;
    }

    public function getProductCategoryApi(): ProductCategoryApi
    {
        return $this->productCategoryApi;
    }

    public function getProductProductCategoryApi(): ProductProductCategoryApi
    {
        return $this->productProductCategoryApi;
    }

    public function getProductReviewApi(): ProductReviewApi
    {
        return $this->productReviewApi;
    }

    public function getCustomerFavoriteProductApi(): CustomerFavoriteProductApi
    {
        return $this->customerFavoriteProductApi;
    }

    public function getProductRelatedProductApi(): ProductRelatedProductApi
    {
        return $this->productRelatedProductApi;
    }

    public function getProductCrossSellProductApi(): ProductCrossSellProductApi
    {
        return $this->productCrossSellProductApi;
    }

    public function getProductUpSellProductApi(): ProductUpSellProductApi
    {
        return $this->productUpSellProductApi;
    }

    public function getProductVolumeSellProductApi(): ProductVolumeSellProductApi
    {
        return $this->productVolumeSellProductApi;
    }

    public function getProductCustomFieldApi(): ProductCustomFieldApi
    {
        return $this->productCustomFieldApi;
    }

    public function getCustomerCustomFieldApi(): CustomerCustomFieldApi
    {
        return $this->customerCustomFieldApi;
    }

    public function getOrderCustomFieldApi(): OrderCustomFieldApi
    {
        return $this->orderCustomFieldApi;
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
