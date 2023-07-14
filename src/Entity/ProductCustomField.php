<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class ProductCustomField implements CustomFieldInterface
{
    use CustomFieldTrait;

    private Product $product;

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'custom_field_id' => $this->getCustomFieldId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'product' => $this->getProduct()->toIri()
        ];
    }

    public function toIri(): ?string
    {
        return '/product_custom_fields/' . $this->customFieldId;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->product);
    }
}
