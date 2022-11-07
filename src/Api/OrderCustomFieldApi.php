<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\OrderCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Order;
use MailCampaigns\ApiClient\Entity\OrderCustomField;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class OrderCustomFieldApi extends AbstractApi
{
    /**
     * @param EntityInterface|OrderCustomField $entity
     * @return OrderCustomField
     * @throws HttpClientExceptionInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof OrderCustomField) {
            throw new InvalidArgumentException('Expected custom order field entity!');
        }

        // Send request.
        $res = $this->post('order_custom_fields', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return OrderCustomField
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("order_custom_fields/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return OrderCustomFieldCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('order_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, OrderCustomFieldCollection::class);
    }

    /**
     * Updates a custom order field.
     *
     * @param EntityInterface $entity
     * @return OrderCustomField
     * @throws HttpClientExceptionInterface
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof OrderCustomField) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                OrderCustomField::class));
        }

        $res = $this->put("order_custom_fields/{$entity->getCustomFieldId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes a custom order field by id.
     *
     * @param int $id
     * @return $this
     * @throws HttpClientExceptionInterface
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("order_custom_fields/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(array $data): EntityInterface
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
