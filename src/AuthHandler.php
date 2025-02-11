<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Entity\Token;
use Psr\Http\Client\ClientExceptionInterface;

class AuthHandler
{
    private ?Token $token = null;

    public function __construct(
        private readonly ApiClient $apiClient,
        private readonly string $key,
        private readonly string $secret,
        private readonly array $scopes,
    ) {
    }

    /**
     * @throws ApiClientException
     */
    public function getAccessToken(): string
    {
        // Return fresh existing token.
        if ($this->token && !$this->token->hasExpired()) {
            return $this->token->accessToken;
        }

        // Destruct expired token.
        if ($this->token) {
            unset($this->token);
        }

        $request = ($this->apiClient->getRequestFactory()->createRequest('POST', $this->apiClient->getBaseUri() . '/oauth/v2/token'))
            ->withHeader('Authorization', 'Basic ' . base64_encode($this->key . ':' . $this->secret))
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody(
                $this->apiClient->getStreamFactory()->createStream(
                    http_build_query([
                        'grant_type' => 'client_credentials',
                        'scope' => implode(' ', $this->getScopes()),
                    ])
                )
            );

        try {
            $response = $this->apiClient->getHttpClient()->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new ApiClientException('Failed to retrieve access token: ' . $e->getMessage());
        }

        $res = ResponseMediator::getContent($response);

        if (!isset($res['access_token'])) {
            throw new ApiClientException('Failed to retrieve access token.');
        }

        // Create new token instance.
        $this->token = new Token($res['access_token'], time(), $res['expires_in']);

        return $this->token->accessToken;
    }

    /**
     * @throws ApiClientException
     */
    private function getScopes(): array
    {
        // Make sure given scopes are valid.
        if (!empty($this->scopes)) {
            foreach ($this->scopes as $scope) {
                if (in_array($scope, Token::VALID_SCOPES, true)) {
                    continue;
                }

                throw new ApiClientException(
                    'Invalid scope, must be one of/combination of: ' . implode(', ', Token::VALID_SCOPES) . '.'
                );
            }
        }

        return $this->scopes;
    }
}
