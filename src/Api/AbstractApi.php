<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use DateTime;
use DateTimeInterface;
use LogicException;
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\ResponseMediator;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

abstract class AbstractApi implements ApiInterface
{
    /** @var int */
    public const DEFAULT_ITEMS_PER_PAGE = 30;

    public function __construct(protected ApiClient $client)
    {
    }

    /**
     * Processes response expected to contain one item (or no items).
     */
    protected function handleSingleItemResponse(array|string $res): ?array
    {
        if (isset($res['hydra:totalItems'])) {
            if ((int)$res['hydra:totalItems'] > 0) {
                return $res['hydra:member'][0];
            }
        } else {
            if (is_array($res) && count($res) > 0) {
                return $res[0];
            }
        }

        return null;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters (will be sent in the query string).
     * @param array $requestHeaders Request Headers.
     * @throws HttpClientExceptionInterface
     */
    protected function get(
        string $path,
        array $parameters = [],
        array $requestHeaders = []
    ): array|string {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->request('GET', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders)
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters HEAD parameters (will be sent in the query string).
     * @param array $requestHeaders Request headers.
     * @throws HttpClientExceptionInterface
     */
    protected function head(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->request(
            'HEAD',
            $path,
            array_merge(['content-type: application/ld+json'], $requestHeaders)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The entity to be created.
     * @param array $requestHeaders Request headers.
     * @throws HttpClientExceptionInterface
     */
    protected function post(string $path, EntityInterface $entity, array $requestHeaders = []): array|string
    {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        $response = $this->client->getHttpClient()->request('POST', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_POST, true))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The entity to be patched.
     * @param array $requestHeaders Request headers.
     * @throws HttpClientExceptionInterface
     */
    protected function patch(string $path, EntityInterface $entity, array $requestHeaders = []): array|string
    {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        $response = $this->client->getHttpClient()->request('PATCH', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_PATCH, true))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The updated entity to be sent.
     * @param array $requestHeaders Request headers.
     * @throws HttpClientExceptionInterface
     */
    protected function put(string $path, EntityInterface $entity, array $requestHeaders = []): array|string
    {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        $response = $this->client->getHttpClient()->request('PUT', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_PUT, true))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     * @throws HttpClientExceptionInterface
     */
    protected function delete(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        if ($this->client->hasTokenExpired()) {
            $this->client->refreshToken();
        }

        $response = $this->client->getHttpClient()->request('DELETE', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($parameters)
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     *
     * @param array $parameters Request parameters
     */
    protected function createJsonBody(array $parameters): false|string|null
    {
        if (count($parameters) === 0) {
            return null;
        }

        return json_encode($parameters, empty($parameters) ? JSON_FORCE_OBJECT : 0);
    }

    /**
     * Converts datetime string to object.
     */
    protected function toDtObject(?string $time): ?DateTimeInterface
    {
        if (!$time) {
            return null;
        }

        $dt = DateTime::createFromFormat(DateTimeInterface::ATOM, $time);

        if (false === $dt) {
            return null;
        }

        return $dt;
    }

    /**
     * Transforms data array (containing raw items as elements) to a collection
     * of the supplied type containing entities.
     */
    protected function toCollection(array $data, string $fqcn): CollectionInterface
    {
        $invalidFqcnMsg = 'Expected fully qualified class name (FQCN) of collection.';

        if (!class_exists($fqcn)) {
            throw new LogicException($invalidFqcnMsg);
        }

        $collection = new $fqcn();

        if (!$collection instanceof CollectionInterface) {
            throw new LogicException($invalidFqcnMsg);
        }

        $arr = $data['hydra:member'] ?? $data;

        foreach ($arr as $data) {
            $collection->add($this->toEntity($data));
        }

        return $collection;
    }
}
