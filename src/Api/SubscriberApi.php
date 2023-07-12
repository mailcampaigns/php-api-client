<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\SubscriberCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Subscriber;
use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class SubscriberApi extends AbstractApi
{
    const ORDERABLE_PARAMS = [
        'subscriber_id',
        'created_at',
        'updated_at'
    ];

    const DEFAULT_ORDER = [
        'subscriber_id' => 'desc',
        'updated_at' => 'desc'
    ];

    /**
     * @throws HttpClientExceptionInterface
     */
    public function count(?array $filters = null): int
    {
        $params = [
            'page' => 1,
            'itemsPerPage' => 1,
        ];

        if ($filters !== null) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $data = $this->get('subscribers', $params);

        return $data['hydra:totalItems'] ?? 0;
    }


    public function create(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * {@inheritDoc}
     * @return Subscriber
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("subscribers/{$id}"));
    }

    /**
     * Tries to find a subscriber by email address, returns null when no subscriber
     * was found.
     *
     * @param string $emailAddress
     * @return Subscriber|null
     * @throws HttpClientExceptionInterface
     */
    public function getByEmailAddress(string $emailAddress): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('subscribers', ['email_address' => $emailAddress])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Subscriber was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return SubscriberCollection
     */
    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $filters = null
    ): CollectionInterface
    {
        $params = [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ];

        if ($filters !== null) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $data = $this->get('subscribers', $params);

        return $this->toCollection($data, SubscriberCollection::class);
    }


    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported!');
    }


    public function deleteById($id): ApiInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * @inheritDoc
     * @return Subscriber
     */
    public function toEntity(array $data): EntityInterface
    {
        return (new Subscriber())
            ->setSubscriberId($data['subscriber_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at'] ?? null))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setEmailAddress($data['email_address'])
            ->setIsSubscribed($data['is_subscribed'])
            ->setIsConfirmed($data['is_confirmed'])
            ->setData($data['data']);
    }
}
