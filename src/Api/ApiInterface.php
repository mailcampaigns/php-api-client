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
    public const OPERATION_GET = 'GET';
    public const OPERATION_PUT = 'PUT';
    public const OPERATION_POST = 'POST';
    public const OPERATION_PATCH = 'PATCH';
    public const OPERATION_DELETE = 'DELETE';

    /**
     * Creates a new resource.
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    public function create(EntityInterface $entity): EntityInterface;

    /**
     * Retrieves a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    public function getById(int|string $id): EntityInterface;

    /**
     * Retrieves a collection of resources.
     *
     * @param int|null $page Defaults to first page.
     * @param int|null $perPage Number of resources to retrieve. If not supplied, uses
     *  default number of resources per page.
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    public function getCollection(?int $page, ?int $perPage): CollectionInterface;

    /**
     * Updates a resource.
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    public function update(EntityInterface $entity): EntityInterface;

    /**
     * Deletes a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws McApiException|HttpClientExceptionInterface
     * @api
     */
    public function deleteById(int|string $id): ApiInterface;

    /**
     * Converts an array of resource data to an entity (object).
     */
    public function toEntity(array $data): EntityInterface;
}
