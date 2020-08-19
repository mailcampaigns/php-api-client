<?php

namespace MailCampaigns\ApiClient\Api;

use DateTime;
use InvalidArgumentException;
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\Entity\EntityInterface;
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
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Processes response expected to contain one item (or no items).
     *
     * @param $res
     * @return array|null
     */
    protected function handleSingleItemResponse($res): ?array
    {
        if (isset($res['hydra:totalItems'])) {
            if ((int)$res['hydra:totalItems'] > 0) {
                return $res['hydra:member'][0];
            }
        }

        return null;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters.
     * @param array $requestHeaders Request Headers.
     * @return array|string
     */
    protected function get($path, array $parameters = [], array $requestHeaders = [])
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->request('GET', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders)
        ]);
dump(json_decode($response->getContent()));
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
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->request('HEAD', $path,
            array_merge(['content-type: application/ld+json'], $requestHeaders));

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The entity to be created.
     * @param array $requestHeaders Request headers.
     * @return array|string
     */
    protected function post($path, EntityInterface $entity, array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('POST', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_POST))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The entity to be patched.
     * @param array $requestHeaders Request headers.
     * @return array|string
     */
    protected function patch($path, EntityInterface $entity, array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('PATCH', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_PATCH))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The updated entity to be sent.
     * @param array $requestHeaders Request headers.
     * @return array|string
     */
    protected function put($path, EntityInterface $entity, array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request('PUT', $path, [
            'headers' => array_merge(['content-type: application/ld+json'], $requestHeaders),
            'body' => $this->createJsonBody($entity->toArray(self::OPERATION_PUT))
        ]);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     * @param array $requestHeaders Request headers.
     * @return array|string
     */
    protected function delete($path, array $parameters = [], array $requestHeaders = [])
    {
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

    /**
     * Validates given entity instance against a concrete entity type.
     *
     * @param EntityInterface $entity
     * @param string $type
     * @return $this
     * @throws InvalidArgumentException
     */
    protected function validateEntityType(EntityInterface $entity, string $type): self
    {
        if (!$entity instanceof $type) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!', $type));
        }

        return $this;
    }
}
