<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerCustomField;

class CustomerCustomFieldApi extends AbstractApi
{
    /**
     * @param EntityInterface|CustomerCustomField $entity
     * @return CustomerCustomField
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof CustomerCustomField) {
            throw new InvalidArgumentException('Expected custom customer field entity!');
        }

        // Send request.
        $res = $this->post('customer_custom_fields', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return CustomerCustomField
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("customer_custom_fields/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return CustomerCustomFieldCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('customer_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, CustomerCustomFieldCollection::class);
    }

    /**
     * Updates a custom customer field.
     *
     * @param EntityInterface $entity
     * @return CustomerCustomField
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof CustomerCustomField) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                CustomerCustomField::class));
        }

        $res = $this->put("customer_custom_fields/{$entity->getCustomFieldId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes a custom customer field by id.
     *
     * @param int $id
     * @return $this
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("customer_custom_fields/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(array $data): EntityInterface
    {
        $customField = (new CustomerCustomField)
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked customer.
        if (isset($data['customer']) && is_string($data['customer'])) {
            if (false !== preg_match('/\/customers\/(\d+)/', $data['customer'], $matches)) {
                if (isset($matches[1])) {
                    $customer = (new Customer)->setCustomerId((int)$matches[1]);
                    $customField->setCustomer($customer);
                }
            }
        }

        return $customField;
    }
}
