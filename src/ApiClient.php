<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Exception;
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
use MailCampaigns\ApiClient\Api\QuoteCustomFieldApi;
use MailCampaigns\ApiClient\Api\QuoteProductApi;
use MailCampaigns\ApiClient\Api\SentMailApi;
use MailCampaigns\ApiClient\Api\SubscriberApi;
use MailCampaigns\ApiClient\Exception\ApiAuthenticationException;
use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ApiClient
{
    /** @var int A buffer time in seconds to consider a bearer token to be expired. */
    const EXPIRATION_BUFFER_SECS = 10;
    private static ?ApiClient $instance = null;
    private ?string $bearerToken = null;
    private ?DateTimeInterface $tokenExpirationDt = null;
    private CustomerApi $customerApi;
    private CustomerCustomFieldApi $customerCustomFieldApi;
    private QuoteApi $quoteApi;
    private QuoteCustomFieldApi $quoteCustomFieldApi;
    private QuoteProductApi $quoteProductApi;
    private OrderApi $orderApi;
    private OrderCustomFieldApi $orderCustomFieldApi;
    private OrderProductApi $orderProductApi;
    private ProductApi $productApi;
    private ProductCategoryApi $productCategoryApi;
    private ProductProductCategoryApi $productProductCategoryApi;
    private ProductReviewApi $productReviewApi;
    private CustomerFavoriteProductApi $customerFavoriteProductApi;
    private ProductRelatedProductApi $productRelatedProductApi;
    private ProductCrossSellProductApi $productCrossSellProductApi;
    private ProductUpSellProductApi $productUpSellProductApi;
    private ProductVolumeSellProductApi $productVolumeSellProductApi;
    private ProductCustomFieldApi $productCustomFieldApi;
    private SentMailApi $sentMailApi;
    private SubscriberApi $subscriberApi;

    private function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $key,
        private readonly string $secret,
    ) {
        $this->customerApi = new CustomerApi($this);
        $this->customerCustomFieldApi = new CustomerCustomFieldApi($this);
        $this->orderApi = new OrderApi($this);
        $this->orderCustomFieldApi = new OrderCustomFieldApi($this);
        $this->orderProductApi = new OrderProductApi($this);
        $this->quoteApi = new QuoteApi($this);
        $this->quoteCustomFieldApi = new QuoteCustomFieldApi($this);
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
        $this->sentMailApi = new SentMailApi($this);
        $this->subscriberApi = new SubscriberApi($this);
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

    public function getQuoteCustomFieldApi(): QuoteCustomFieldApi
    {
        return $this->quoteCustomFieldApi;
    }

    public function getSentMailApi(): SentMailApi
    {
        return $this->sentMailApi;
    }

    public function getSubscriberApi(): SubscriberApi
    {
        return $this->subscriberApi;
    }

    public static function create(HttpClientInterface $httpClient, string $key, string $secret): self
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($httpClient, $key, $secret);
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
     * Checks if bearer token has expired.
     */
    public function hasTokenExpired(): bool
    {
        $secondsLeft = $this->tokenExpirationDt->getTimestamp() - (new DateTime())->getTimestamp();
        return $secondsLeft <= self::EXPIRATION_BUFFER_SECS;
    }

    public function refreshToken(): self
    {
        $this->createHttpClient($this->getBearerToken());
        return $this;
    }

    /**
     * Retrieves access (bearer) token.
     */
    public function getBearerToken(): string
    {
        if ($this->bearerToken && !$this->hasTokenExpired()) {
            return $this->bearerToken;
        }

        $options = [
            'headers' => [
                'Authorization: Basic ' . base64_encode($this->key . ':' . $this->secret),
                'Accept: application/json',
            ],
            'body' => [
                'scope' => 'read write',
                'grant_type' => 'client_credentials'
            ],
        ];

        try {
            $response = $this->httpClient->request('POST', 'oauth/v2/token', $options);
            $res = ResponseMediator::getContent($response);
        } catch (ExceptionInterface $e) {
            throw new ApiAuthenticationException('Failed to retrieve access token.', 0, $e);
        }

        if (isset($res['access_token'])) {
            // Remember the moment the token will expire to check before requests.
            if (isset($res['expires_in'])) {
                $this->setTokenExpiration($res['expires_in']);
            }

            $this->bearerToken = $res['access_token'];

            return $this->bearerToken;
        }

        $errMsg = 'Failed to retrieve access token.';

        if (isset($res['error'])) {
            $errMsg .= sprintf(' [%s] %s.', $res['error'], $res['error_description'] ?? '');
        }

        throw new ApiAuthenticationException($errMsg);
    }

    /**
     * Sets the moment the bearer token will expire.
     */
    private function setTokenExpiration(int $expInSeconds): void
    {
        try {
            $interval = (new DateInterval(sprintf('PT%dS', $expInSeconds)));
        } catch (Exception $e) {
            throw new ApiException('Failed to set token expiration: ' . $e->getMessage(), 0, $e);
        }

        $this->tokenExpirationDt = (new DateTime())->add($interval);
    }

    /**
     * Checks if bearer token has expired.
     */
    private function hasTokenExpired(): bool
    {
        if (!$this->tokenExpirationDt) {
            return true;
        }

        $secondsLeft = $this->tokenExpirationDt->getTimestamp() - (new DateTime())->getTimestamp();
        return $secondsLeft <= 0;
    }
}
