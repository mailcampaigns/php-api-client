<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Exception\ApiException;
use MailCampaigns\ApiClient\Exception\ApiLimitExceededException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|string
     * @throws HttpClientExceptionInterface
     */
    public static function getContent(ResponseInterface $response)
    {
        try {
            $body = $response->getContent();
        } catch (ClientException $e) {
            throw new ApiException('API request failed! ' . $e->getMessage(), 0, $e);
        }

        $content = json_decode($body, true);

        if (JSON_ERROR_NONE === json_last_error()) {
            return $content;
        }

        return $body;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array|void
     * @throws HttpClientExceptionInterface
     */
    public static function getPagination(ResponseInterface $response)
    {
        if (!in_array('Link', $response->getHeaders(), true)) {
            return;
        }

        $header = self::getHeader($response, 'Link');
        $pagination = [];
        foreach (explode(',', $header) as $link) {
            preg_match('/<(.*)>; rel="(.*)"/i', trim($link, ','), $match);

            if (3 === count($match)) {
                $pagination[$match[2]] = $match[1];
            }
        }

        return $pagination;
    }

    /**
     * Todo: Implement
     * @throws HttpClientExceptionInterface
     */
    public static function getApiLimit(ResponseInterface $response): int
    {
        $remainingCalls = self::getHeader($response, 'X-RateLimit-Remaining');

        if (null !== $remainingCalls && 1 > (int)$remainingCalls) {
            throw new ApiLimitExceededException((int)$remainingCalls);
        }

        return (int)$remainingCalls;
    }

    /**
     * Get the value for a single header.
     *
     * @param ResponseInterface $response
     * @param string $name
     * @return string|null
     * @throws HttpClientExceptionInterface
     */
    public static function getHeader(ResponseInterface $response, $name)
    {
        $headers = $response->getHeaders()[$name];

        return array_shift($headers);
    }
}
