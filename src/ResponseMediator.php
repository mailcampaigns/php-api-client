<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * @throws ApiClientException
     */
    public static function getContent(ResponseInterface $response): array|null
    {
        $code = $response->getStatusCode();
        $content = json_decode($response->getBody()->getContents(), true);

        if ($code >= 400) {
            $msg = $response->getReasonPhrase();

            if (
                json_last_error() === JSON_ERROR_NONE &&
                array_key_exists('@type', $content)
            ) {
                $msg .= ': ' . ($content['title'] ?? '') . ': ' . ($content['detail'] ?? '');
            }

            throw new ApiClientException($code . ' ' . $msg, $code);
        }

        return $content;
    }
}
