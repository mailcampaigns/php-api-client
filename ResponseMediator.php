<?php

namespace MailCampaigns\ApiClient;

use MailCampaigns\ApiClient\Exception\ApiException;
use MailCampaigns\ApiClient\Exception\ApiLimitExceededException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|string
     */
    public static function getContent(ResponseInterface $response)
    {
        try {
            $body = $response->getContent();
        } catch (ClientException $e) {
            throw new ApiException('API request failed!', 0, $e);
        }

//        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
//        }

        return $body;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array|void
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
     * @param ResponseInterface $response
     * @return null|string
     */
    public static function getApiLimit(ResponseInterface $response)
    {
        $remainingCalls = self::getHeader($response, 'X-RateLimit-Remaining');

        if (null !== $remainingCalls && 1 > $remainingCalls) {
            throw new ApiLimitExceededException($remainingCalls);
        }

        return $remainingCalls;
    }

    /**
     * Get the value for a single header.
     *
     * @param ResponseInterface $response
     * @param string $name
     * @return string|null
     */
    public static function getHeader(ResponseInterface $response, $name)
    {
        $headers = $response->getHeaders()[$name];

        return array_shift($headers);
    }
}
