<?php

namespace MailCampaigns\ApiClient\Entity;

class OrderCustomField implements EntityInterface, CustomFieldInterface
{
    use CustomFieldTrait;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @return Order
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     * @return OrderCustomField
     */
    public function setOrder(?Order $order): OrderCustomField
    {
        $this->order = $order;
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
            'order' => $this->getOrder()->toIri()
        ];
    }

    public function toIri(): ?string
    {
        return '/order_custom_fields/' . $this->customFieldId;
    }
}
