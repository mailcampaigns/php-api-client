<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ResponseMediator
{
    /**
     * @throws ExceptionInterface
     */
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = $response->getContent();
        $content = json_decode($body, true);

        if (JSON_ERROR_NONE === json_last_error()) {
            return $content;
        }

        return $body;
    }

    /**
     * @throws ExceptionInterface
     */
    public static function getPagination(ResponseInterface $response): ?array
    {
        if (!in_array('Link', $response->getHeaders(), true)) {
            return null;
        }

        $header = array_shift($response->getHeaders()['Link']);

        $pagination = [];
        foreach (explode(',', $header) as $link) {
            preg_match('/<(.*)>; rel="(.*)"/i', trim($link, ','), $match);

            if (3 === count($match)) {
                $pagination[$match[2]] = $match[1];
            }
        }

        return $pagination;
    }
}
