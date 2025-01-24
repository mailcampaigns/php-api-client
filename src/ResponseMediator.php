<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * @throws ApiClientException
     */
    public static function getContent(ResponseInterface $response): array|string
    {
        if ($response->getStatusCode() >= 400) {
            throw new ApiClientException($response->getStatusCode() . ' ' . $response->getReasonPhrase() . PHP_EOL . $response->getBody()->getContents() . PHP_EOL . json_encode($response->getHeaders()), $response->getStatusCode());
        }

        $body = $response->getBody()->getContents();

        $content = json_decode($body, true);

        if (JSON_ERROR_NONE === json_last_error()) {
            return $content;
        }

        return $body;
    }
}
