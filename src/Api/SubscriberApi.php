<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\SubscriberCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Subscriber;
use MailCampaigns\ApiClient\Exception\ApiException;

class SubscriberApi extends AbstractApi
{
    const ORDERABLE_PARAMS = [];

    const DEFAULT_ORDER = [
        'subscriber_id' => 'desc'
    ];

    /**
     * {@inheritDoc}
     */
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
    public function getCollection(?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('subscribers', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, SubscriberCollection::class);
    }

    /**
     * {@inheritDoc}
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * @inheritDoc
     */
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
            ->setEmailAddress($data['email_address'])
            ->setIsSubscribed($data['is_subscribed'])
            ->setIsConfirmed($data['is_confirmed'])
            ->setData($data['data']);
    }
}
