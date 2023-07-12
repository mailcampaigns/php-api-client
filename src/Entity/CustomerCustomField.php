<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class CustomerCustomField implements CustomFieldInterface
{
    use CustomFieldTrait;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @return Customer
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     * @return CustomerCustomField
     */
    public function setCustomer(?Customer $customer): CustomerCustomField
    {
        $this->customer = $customer;
        return $this;
    }

    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'custom_field_id' => $this->getCustomFieldId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'customer' => $this->getCustomer()->toIri()
        ];
    }

    public function toIri(): ?string
    {
        return '/customer_custom_fields/' . $this->customFieldId;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->customer);
    }
}
