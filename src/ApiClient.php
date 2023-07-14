<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use DateInterval;
use DateTime;
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
use MailCampaigns\ApiClient\Api\QuoteProductApi;
use MailCampaigns\ApiClient\Api\SentMailApi;
use MailCampaigns\ApiClient\Api\SubscriberApi;
use MailCampaigns\ApiClient\Exception\ApiAuthenticationException;
use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ApiClient
{
    private static ?ApiClient $instance = null;
    private ?HttpClientInterface $httpClient;
    private CustomerApi $customerApi;
    private QuoteApi $quoteApi;
    private QuoteProductApi $quoteProductApi;
    private OrderApi $orderApi;
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
    private CustomerCustomFieldApi $customerCustomFieldApi;
    private OrderCustomFieldApi $orderCustomFieldApi;
    private SentMailApi $sentMailApi;
    private SubscriberApi $subscriberApi;
    private string $baseUri;
    private string $key;
    private string $secret;
    private DateTime $tokenExpirationDt;

    private function __construct(string $baseUri, string $key, string $secret)
    {
        $this->baseUri = $baseUri;
        $this->key = $key;
        $this->secret = $secret;

        // Request an access token.
        $bearerToken = $this->getBearerToken();

        // Create an instance of the HTTP client.
        $this->createHttpClient($bearerToken);

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

    public function getSentMailApi(): SentMailApi
    {
        return $this->sentMailApi;
    }

    public function getSubscriberApi(): SubscriberApi
    {
        return $this->subscriberApi;
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
     * Checks if bearer token has expired.
     */
    public function hasTokenExpired(): bool
    {
        $secondsLeft = $this->tokenExpirationDt->getTimestamp() - (new DateTime())->getTimestamp();
        return $secondsLeft <= 0;
    }

    public function refreshToken(): self
    {
        $this->createHttpClient($this->getBearerToken());
        return $this;
    }

    /**
     * Retrieves access (bearer) token.
     */
    private function getBearerToken(): string
    {
        $curl = curl_init();

        // Set Curl options.
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUri . '/oauth/v2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'scope' => 'read write',
                'grant_type' => 'client_credentials'
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($this->key . ':' . $this->secret)
            ]
        ]);

        $response = curl_exec($curl);

        if (false === $response) {
            throw new ApiAuthenticationException(
                sprintf('Failed to retrieve access token: `%s`.', curl_error($curl)),
                curl_errno($curl)
            );
        }

        curl_close($curl);

        $decodedResponse = json_decode($response);

        if ($decodedResponse) {
            if (isset($decodedResponse->access_token)) {
                // Remember the moment the token will expirate to check on requests later.
                if (isset($decodedResponse->expires_in)) {
                    $this->setTokenExpiration($decodedResponse->expires_in);
                }

                return $decodedResponse->access_token;
            }

            if (isset($decodedResponse->error)) {
                $error = $decodedResponse->error;
                $errorDescription = $decodedResponse->error_description ?? '(no error description)';

                throw new ApiAuthenticationException(sprintf(
                    'Failed to retrieve access token: [%s] %s.',
                    $error,
                    $errorDescription
                ));
            }
        }

        throw new ApiAuthenticationException('Could not retrieve access token! '
            . 'Received an unexpected response from the authentication server.');
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

    private function createHttpClient(string $bearerToken): void
    {
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'MailCampaigns PHP API client ' . $this->getComposerPackageVersion()
            ],
            'auth_bearer' => $bearerToken,
            'base_uri' => $this->baseUri
        ]);
    }

    /**
     * Get version of this package from Composer configuration.
     */
    private function getComposerPackageVersion(): string
    {
        $composerConfig = json_decode(file_get_contents(__DIR__ . '/../composer.json'));
        return $composerConfig->version;
    }
}
