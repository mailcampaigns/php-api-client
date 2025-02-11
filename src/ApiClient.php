<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use Http\Factory\Discovery\ClientLocator;
use Http\Factory\Discovery\HttpClient;
use Http\Factory\Discovery\HttpFactory;
use MailCampaigns\ApiClient\Api\{CustomerApi,
    CustomerCustomFieldApi,
    CustomerFavoriteProductApi,
    OrderApi,
    OrderCustomFieldApi,
    OrderProductApi,
    ProductApi,
    ProductCategoryApi,
    ProductCrossSellProductApi,
    ProductCustomFieldApi,
    ProductProductCategoryApi,
    ProductRelatedProductApi,
    ProductReviewApi,
    ProductUpSellProductApi,
    ProductVolumeSellProductApi,
    QuoteApi,
    QuoteCustomFieldApi,
    QuoteProductApi,
    SentMailApi,
    SubscriberApi};
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class ApiClient
{
    /**
     * @var string The default base Uri of our API.
     * @api
     */
    public const DEFAULT_BASE_URI = 'https://api-v3.mailcampaigns.nl';

    /** @var ApiClient|null Holds the only instance of this class (Singleton). */
    private static ?self $instance = null;

    private ?string $baseUri = null;
    private AuthHandler $authHandler;
    private ?ClientInterface $httpClient = null;
    private ?RequestFactoryInterface $requestFactory = null;
    private ?StreamFactoryInterface $streamFactory = null;
    private ?CustomerApi $customerApi = null;
    private ?CustomerCustomFieldApi $customerCustomFieldApi = null;
    private ?QuoteApi $quoteApi = null;
    private ?QuoteCustomFieldApi $quoteCustomFieldApi = null;
    private ?QuoteProductApi $quoteProductApi = null;
    private ?OrderApi $orderApi = null;
    private ?OrderCustomFieldApi $orderCustomFieldApi = null;
    private ?OrderProductApi $orderProductApi = null;
    private ?ProductApi $productApi = null;
    private ?ProductCategoryApi $productCategoryApi = null;
    private ?ProductProductCategoryApi $productProductCategoryApi = null;
    private ?ProductReviewApi $productReviewApi = null;
    private ?CustomerFavoriteProductApi $customerFavoriteProductApi = null;
    private ?ProductRelatedProductApi $productRelatedProductApi = null;
    private ?ProductCrossSellProductApi $productCrossSellProductApi = null;
    private ?ProductUpSellProductApi $productUpSellProductApi = null;
    private ?ProductVolumeSellProductApi $productVolumeSellProductApi = null;
    private ?ProductCustomFieldApi $productCustomFieldApi = null;
    private ?SentMailApi $sentMailApi = null;
    private ?SubscriberApi $subscriberApi = null;

    private function __construct(
        string $key,
        string $secret,
        array $scopes = ['read', 'write'],
    ) {
        $this->authHandler = new AuthHandler($this, $key, $secret, $scopes);

        if (class_exists('\Symfony\Component\HttpClient\Psr18Client')) {
            ClientLocator::register(ClientInterface::class, '\Symfony\Component\HttpClient\Psr18Client');
        }
    }

    /**
     * Prevent cloning of the instance.
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserializing of the instance.
     * @throws ApiClientException
     */
    public function __wakeup(): void
    {
        throw new ApiClientException('Cannot unserialize a singleton.');
    }

    /**
     * @api
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri ?? '';
    }

    /**
     * @api
     */
    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    public function getHttpClient(): ClientInterface
    {
        if (empty($this->httpClient)) {
            $this->httpClient = HttpClient::client();
        }

        return $this->httpClient;
    }

    /**
     * @api
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        if (empty($this->requestFactory)) {
            $this->requestFactory = HttpFactory::requestFactory();
        }

        return $this->requestFactory;
    }

    /**
     * @api
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): self
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    public function getStreamFactory(): StreamFactoryInterface
    {
        if (empty($this->streamFactory)) {
            $this->streamFactory = HttpFactory::streamFactory();
        }

        return $this->streamFactory;
    }

    /**
     * @throws ApiClientException
     */
    public function getAccessToken(): string
    {
        return $this->authHandler->getAccessToken();
    }

    /**
     * @api
     */
    public function getCustomerApi(): CustomerApi
    {
        if (null === $this->customerApi) {
            $this->customerApi = new CustomerApi($this);
        }

        return $this->customerApi;
    }

    /**
     * @api
     */
    public function getOrderApi(): OrderApi
    {
        if (null === $this->orderApi) {
            $this->orderApi = new OrderApi($this);
        }

        return $this->orderApi;
    }

    /**
     * @api
     */
    public function getOrderProductApi(): OrderProductApi
    {
        if (null === $this->orderProductApi) {
            $this->orderProductApi = new OrderProductApi($this);
        }

        return $this->orderProductApi;
    }

    /**
     * @api
     */
    public function getQuoteApi(): QuoteApi
    {
        if (null === $this->quoteApi) {
            $this->quoteApi = new QuoteApi($this);
        }

        return $this->quoteApi;
    }

    /**
     * @api
     */
    public function getQuoteProductApi(): QuoteProductApi
    {
        if (null === $this->quoteProductApi) {
            $this->quoteProductApi = new QuoteProductApi($this);
        }

        return $this->quoteProductApi;
    }

    /**
     * @api
     */
    public function getProductApi(): ProductApi
    {
        if (null === $this->productApi) {
            $this->productApi = new ProductApi($this);
        }

        return $this->productApi;
    }

    /**
     * @api
     */
    public function getProductCategoryApi(): ProductCategoryApi
    {
        if (null === $this->productCategoryApi) {
            $this->productCategoryApi = new ProductCategoryApi($this);
        }

        return $this->productCategoryApi;
    }

    /**
     * @api
     */
    public function getProductProductCategoryApi(): ProductProductCategoryApi
    {
        if (null === $this->productProductCategoryApi) {
            $this->productProductCategoryApi = new ProductProductCategoryApi($this);
        }

        return $this->productProductCategoryApi;
    }

    /**
     * @api
     */
    public function getProductReviewApi(): ProductReviewApi
    {
        if (null === $this->productReviewApi) {
            $this->productReviewApi = new ProductReviewApi($this);
        }

        return $this->productReviewApi;
    }

    /**
     * @api
     */
    public function getCustomerFavoriteProductApi(): CustomerFavoriteProductApi
    {
        if (null === $this->customerFavoriteProductApi) {
            $this->customerFavoriteProductApi = new CustomerFavoriteProductApi($this);
        }

        return $this->customerFavoriteProductApi;
    }

    /**
     * @api
     */
    public function getProductRelatedProductApi(): ProductRelatedProductApi
    {
        if (null === $this->productRelatedProductApi) {
            $this->productRelatedProductApi = new ProductRelatedProductApi($this);
        }

        return $this->productRelatedProductApi;
    }

    /**
     * @api
     */
    public function getProductCrossSellProductApi(): ProductCrossSellProductApi
    {
        if (null === $this->productCrossSellProductApi) {
            $this->productCrossSellProductApi = new ProductCrossSellProductApi($this);
        }

        return $this->productCrossSellProductApi;
    }

    /**
     * @api
     */
    public function getProductUpSellProductApi(): ProductUpSellProductApi
    {
        if (null === $this->productUpSellProductApi) {
            $this->productUpSellProductApi = new ProductUpSellProductApi($this);
        }

        return $this->productUpSellProductApi;
    }

    /**
     * @api
     */
    public function getProductVolumeSellProductApi(): ProductVolumeSellProductApi
    {
        if (null === $this->productVolumeSellProductApi) {
            $this->productVolumeSellProductApi = new ProductVolumeSellProductApi($this);
        }

        return $this->productVolumeSellProductApi;
    }

    /**
     * @api
     */
    public function getProductCustomFieldApi(): ProductCustomFieldApi
    {
        if (null === $this->productCustomFieldApi) {
            $this->productCustomFieldApi = new ProductCustomFieldApi($this);
        }

        return $this->productCustomFieldApi;
    }

    /**
     * @api
     */
    public function getCustomerCustomFieldApi(): CustomerCustomFieldApi
    {
        if (null === $this->customerCustomFieldApi) {
            $this->customerCustomFieldApi = new CustomerCustomFieldApi($this);
        }

        return $this->customerCustomFieldApi;
    }

    /**
     * @api
     */
    public function getOrderCustomFieldApi(): OrderCustomFieldApi
    {
        if (null === $this->orderCustomFieldApi) {
            $this->orderCustomFieldApi = new OrderCustomFieldApi($this);
        }

        return $this->orderCustomFieldApi;
    }

    /**
     * @api
     */
    public function getQuoteCustomFieldApi(): QuoteCustomFieldApi
    {
        if (null === $this->quoteCustomFieldApi) {
            $this->quoteCustomFieldApi = new QuoteCustomFieldApi($this);
        }

        return $this->quoteCustomFieldApi;
    }

    /**
     * @api
     */
    public function getSentMailApi(): SentMailApi
    {
        if (null === $this->sentMailApi) {
            $this->sentMailApi = new SentMailApi($this);
        }

        return $this->sentMailApi;
    }

    /**
     * @api
     */
    public function getSubscriberApi(): SubscriberApi
    {
        if (null === $this->subscriberApi) {
            $this->subscriberApi = new SubscriberApi($this);
        }

        return $this->subscriberApi;
    }

    /**
     * @api
     */
    public static function getInstance(string $key, string $secret, array $scopes = []): self {
        if (!self::$instance instanceof self) {
            self::$instance = new self($key, $secret, $scopes);
        }

        return self::$instance;
    }
}
