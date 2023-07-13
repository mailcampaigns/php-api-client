<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\OrderCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Order;
use MailCampaigns\ApiClient\Entity\OrderCustomField;

class OrderCustomFieldApi extends AbstractApi implements CustomFieldApiInterface
{
    public function create(OrderCustomField|EntityInterface $entity): OrderCustomField
    {
        assert($entity instanceof OrderCustomField);
        return $this->toEntity($this->post('order_custom_fields', $entity));
    }

    public function getById(int|string $id): OrderCustomField
    {
        return $this->toEntity($this->get("order_custom_fields/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): OrderCustomFieldCollection {
        $data = $this->get('order_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, OrderCustomFieldCollection::class);
        assert($collection instanceof OrderCustomFieldCollection);

        return $collection;
    }

    public function update(OrderCustomField|EntityInterface $entity): OrderCustomField
    {
        assert($entity instanceof OrderCustomField);

        return $this->toEntity(
            $this->put("order_custom_fields/{$entity->getCustomFieldId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("order_custom_fields/$id");
        return $this;
    }


    public function toEntity(array $data): OrderCustomField
    {
        $customField = (new OrderCustomField)
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked order.
        if (isset($data['order']) && is_string($data['order'])) {
            if (false !== preg_match('/\/orders\/(\d+)/', $data['order'], $matches)) {
                if (isset($matches[1])) {
                    $order = (new Order)->setOrderId((int)$matches[1]);
                    $customField->setOrder($order);
                }
            }
        }

        return $customField;
    }
}
