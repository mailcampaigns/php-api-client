<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;

/**
 * Represents an API endpoint.
 */
interface ApiInterface
{
    /** @var int */
    const DEFAULT_ITEMS_PER_PAGE = 30;
    const OPERATION_GET = 'GET';
    const OPERATION_PUT = 'PUT';
    const OPERATION_POST = 'POST';
    const OPERATION_PATCH = 'PATCH';

    /**
     * Creates a new resource.
     *
     * @throws ApiClientException
     * @api
     */
    function create(EntityInterface $entity): EntityInterface;

    /**
     * Retrieves a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws ApiClientException
     * @api
     */
    function getById(int|string $id): EntityInterface;

    /**
     * Retrieves a collection of resources.
     *
     * @param int|null $page Defaults to first page.
     * @param int|null $perPage Number of resources to retrieve. If not supplied, uses
     *  default number of resources per page.
     * @throws ApiClientException
     * @api
     */
    function getCollection(?int $page, ?int $perPage): CollectionInterface;

    /**
     * Updates a resource.
     *
     * @throws ApiClientException
     * @api
     */
    function update(EntityInterface $entity): EntityInterface;

    /**
     * Deletes a resource by id.
     * Note: Compound keys can be used i.e. like this: customer=1;favoriteProduct=2
     *
     * @throws ApiClientException
     * @api
     */
    function deleteById(int|string $id): ApiInterface;

    /**
     * Processes response expected to contain one item (or no items).
     */
    function handleSingleItemResponse(array|string $res): ?array;

    /**
     * Converts an array of resource data to an entity (object).
     */
    function toEntity(array $data): EntityInterface;
}
