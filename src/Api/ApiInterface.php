<?php

declare(strict_types=1);

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
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    function create(EntityInterface $entity): EntityInterface;

    /**
     * Retrieves a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    function getById(int|string $id): EntityInterface;

    /**
     * Retrieves a collection of resources.
     *
     * @param int|null $page Defaults to first page.
     * @param int|null $perPage Number of resources to retrieve. If not supplied, uses
     *  default number of resources per page.
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    function getCollection(?int $page, ?int $perPage): CollectionInterface;

    /**
     * Updates a resource.
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    function update(EntityInterface $entity): EntityInterface;

    /**
     * Deletes a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    function deleteById(int|string $id): ApiInterface;

    /**
     * Converts an array of resource data to an entity (object).
     */
    function toEntity(array $data): EntityInterface;
}
