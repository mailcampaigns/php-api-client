<?php

namespace MailCampaigns\ApiClient\Api;

use DateTime;
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\ResponseMediator;

abstract class AbstractApi implements ApiInterface
{
    /** @var int */
    const DEFAULT_ITEMS_PER_PAGE = 30;

    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * The requested page.
     *
     * @var int
     */
    protected $page;

    /**
     * Number of items per page.
     *
     * @var int
     */
    protected $perPage;

    /**
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->page = 1;
        $this->perPage = self::DEFAULT_ITEMS_PER_PAGE;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function setPage(int $page): ApiInterface
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @inheritDoc
     */
    public function setPerPage(int $perPage): ApiInterface
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters.
     * @param array $requestHeaders Request Headers.
     *
     * @return array|string
     */
    protected function get($path, array $parameters = [], array $requestHeaders = [])
    {
        if (null !== $this->page && !isset($parameters['page'])) {
            $parameters['page'] = $this->page;
        }
        if (null !== $this->perPage && !isset($parameters['per_page'])) {
            $parameters['per_page'] = $this->perPage;
        }
        if (array_key_exists('ref', $parameters) && null === $parameters['ref']) {
            unset($parameters['ref']);
        }

        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->request('GET', $path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters HEAD parameters.
     * @param array $requestHeaders Request headers.
     * @return array|string
     */
    protected function head($path, array $parameters = [], array $requestHeaders = [])
    {
        if (array_key_exists('ref', $parameters) && null === $parameters['ref']) {
            unset($parameters['ref']);
        }

        $url = $path . '?' . http_build_query($parameters);
        $response = $this->client->getHttpClient()->request('HEAD', $url, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function post($path, array $parameters = [], array $requestHeaders = [])
    {
        return $this->postRaw($path, $this->createJsonBody($parameters), $requestHeaders);
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string $path Request path.
     * @param string $body Request body.
     * @param array $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function postRaw($path, $body, array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('POST', $path, [
            'headers' => $requestHeaders,
            'body' => $body
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function patch($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('PATCH', $path, [
            'headers' => $requestHeaders,
            'body' => $this->createJsonBody($parameters)
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function put($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('PUT', $path, [
            'headers' => $requestHeaders,
            'body' => $this->createJsonBody($parameters)
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function delete($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('DELETE', $path, [
            'headers' => $requestHeaders,
            'body' => $this->createJsonBody($parameters)
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     *
     * @param array $parameters Request parameters
     * @return null|string
     */
    protected function createJsonBody(array $parameters)
    {
        if (count($parameters) === 0) {
            return null;
        }

        return json_encode($parameters, empty($parameters) ? JSON_FORCE_OBJECT : 0);
    }

    /**
     * Converts datetime string to object.
     *
     * @param string|null $time
     * @return DateTime|null
     */
    protected function toDtObject(?string $time): ?DateTime
    {
        if (!$time) {
            return null;
        }

        return DateTime::createFromFormat(DateTime::ISO8601, $time);
    }
}
