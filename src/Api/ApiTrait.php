<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use DateTime;
use DateTimeInterface;
use LogicException;
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\ResponseMediator;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

trait ApiTrait
{
    public function __construct(protected readonly ApiClient $apiClient)
    {
    }

    /**
     * Processes response expected to contain one item (or no items).
     */
    public function handleSingleItemResponse(array|string $res): ?array
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
     * Send a GET request.
     *
     * @param string $path Request path.
     * @param array $parameters GET parameters (will be sent in the query string).
     * @throws ApiClientException
     */
    private function get(string $path, array $parameters = []): array|string
    {
        $this->prependBaseUri($path);

        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $request = ($this->apiClient->getRequestFactory()->createRequest('GET', $path))
            ->withHeader('Accept', 'application/ld+json')
            ->withHeader('Authorization', 'Bearer ' . $this->apiClient->getBearerToken());

        $response = $this->sendRequest($request);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The entity to be created.
     * @throws ApiClientException
     */
    private function post(string $path, EntityInterface $entity): array|string
    {
        $this->prependBaseUri($path);

        $body = $this->apiClient->getStreamFactory()->createStream(
            $this->createJsonBody($entity->toArray(self::OPERATION_POST, true))
        );

        $request = ($this->apiClient->getRequestFactory()->createRequest('POST', $path))
            ->withHeader('Accept', 'application/ld+json')
            ->withHeader('Authorization', 'Bearer ' . $this->apiClient->getBearerToken())
            ->withHeader('Content-Type', 'application/ld+json')
            ->withBody($body);

        $response = $this->sendRequest($request);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request.
     *
     * @param string $path Request path.
     * @param EntityInterface $entity The updated entity to be sent.
     * @throws ApiClientException
     */
    private function put(string $path, EntityInterface $entity): array|string {
        $this->prependBaseUri($path);

        $body = $this->apiClient->getStreamFactory()->createStream(
            $this->createJsonBody($entity->toArray(self::OPERATION_PUT, true))
        );

        $request = ($this->apiClient->getRequestFactory()->createRequest('PUT', $path))
            ->withHeader('Accept', 'application/ld+json')
            ->withHeader('Authorization', 'Bearer ' . $this->apiClient->getBearerToken())
            ->withHeader('Content-Type', 'application/ld+json')
            ->withBody($body);

        $response = $this->sendRequest($request);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request.
     *
     * @param string $path Request path.
     * @throws ApiClientException
     */
    private function delete(string $path): void {
        $this->prependBaseUri($path);

        $request = ($this->apiClient->getRequestFactory()->createRequest('DELETE', $path))
            ->withHeader('Accept', 'application/ld+json')
            ->withHeader('Authorization', 'Bearer ' . $this->apiClient->getBearerToken());

        $response = $this->sendRequest($request);

//        print $response->getBody()->getContents() . PHP_EOL;
        if ($response->getStatusCode() !== 204) {
            throw new ApiClientException('Failed to delete! ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
        }
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     */
    private function createJsonBody(array $parameters): false|string|null
    {
        if (count($parameters) === 0) {
            return null;
        }

        return json_encode($parameters, empty($parameters) ? JSON_FORCE_OBJECT : 0);
    }

    /**
     * Converts datetime string to object.
     */
    private function toDtObject(?string $time): ?DateTimeInterface
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
    private function toCollection(array $data, string $fqcn): CollectionInterface
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

    /**
     * @throws ApiClientException
     */
    private function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->apiClient->getHttpClient()->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new ApiClientException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function prependBaseUri(string &$path): void
    {
        /** @noinspection HttpUrlsUsage */
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        $path = $this->apiClient->getBaseUri() . '/' . $path;
    }
}
