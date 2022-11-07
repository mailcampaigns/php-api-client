<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Exception\ApiException as McApiException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

/**
 * Represents an API endpoint.
 */
interface ApiInterface
{
    const OPERATION_GET = 'GET';
    const OPERATION_PUT = 'PUT';
    const OPERATION_POST = 'POST';
    const OPERATION_PATCH = 'PATCH';
    const OPERATION_DELETE = 'DELETE';

    /**
     * Creates a new resource.
     *
     * @api
     * @param EntityInterface $entity
     * @return EntityInterface
     * @throws McApiException|HttpClientExceptionInterface
     */
    function create(EntityInterface $entity): EntityInterface;

    /**
     * Retrieves a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @api
     * @param int|string $id
     * @return EntityInterface
     * @throws McApiException|HttpClientExceptionInterface
     */
    function getById($id): EntityInterface;

    /**
     * Retrieves a collection of resources.
     *
     * @api
     * @param int|null $page Defaults to first page.
     * @param int|null $perPage Number of resources to retrieve. If not supplied, uses
     *  default number of resources per page.
     * @return CollectionInterface
     * @throws McApiException|HttpClientExceptionInterface
     */
    function getCollection(?int $page, ?int $perPage): CollectionInterface;

    /**
     * Updates a resource.
     *
     * @api
     * @param EntityInterface $entity
     * @return EntityInterface
     * @throws McApiException|HttpClientExceptionInterface
     */
    function update(EntityInterface $entity): EntityInterface;

    /**
     * Deletes a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @api
     * @param int|string $id
     * @return $this
     * @throws McApiException|HttpClientExceptionInterface
     */
    function deleteById($id): ApiInterface;

    /**
     * Converts an array of resource data to an entity (object).
     *
     * @param array $data
     * @return EntityInterface
     */
    function toEntity(array $data): EntityInterface;
}
