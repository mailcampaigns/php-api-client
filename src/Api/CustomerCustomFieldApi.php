<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CustomerCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerCustomField;

class CustomerCustomFieldApi implements ApiInterface, CustomFieldApiInterface
{
    use ApiTrait;

    public function create(EntityInterface|CustomerCustomField $entity): CustomerCustomField
    {
        assert($entity instanceof CustomerCustomField);
        return $this->toEntity($this->post('customer_custom_fields', $entity));
    }

    public function getById(int|string $id): CustomerCustomField
    {
        return $this->toEntity($this->get("customer_custom_fields/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): CustomerCustomFieldCollection {
        $data = $this->get('customer_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, CustomerCustomFieldCollection::class);
        assert($collection instanceof CustomerCustomFieldCollection);

        return $collection;
    }

    public function update(CustomerCustomField|EntityInterface $entity): CustomerCustomField
    {
        assert($entity instanceof CustomerCustomField);
        return $this->toEntity($this->put("customer_custom_fields/{$entity->getCustomFieldId()}", $entity));
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("customer_custom_fields/$id");
        return $this;
    }

    public function toEntity(array $data): CustomerCustomField
    {
        $customField = (new CustomerCustomField())
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked customer.
        if (isset($data['customer']) && is_string($data['customer'])) {
            if (false !== preg_match('/\/customers\/(\d+)/', $data['customer'], $matches)) {
                if (isset($matches[1])) {
                    $customer = (new Customer())->setCustomerId((int)$matches[1]);
                    $customField->setCustomer($customer);
                }
            }
        }

        return $customField;
    }
}
