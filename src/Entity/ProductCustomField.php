<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductCustomField implements CustomFieldInterface
{
    use CustomFieldTrait;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return ProductCustomField
     */
    public function setProduct(?Product $product): ProductCustomField
    {
        $this->product = $product;
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
            'product' => $this->getProduct()->toIri()
        ];
    }

    public function toIri(): ?string
    {
        return '/product_custom_fields/' . $this->customFieldId;
    }

    public function __destruct()
    {
        unset($this->product);
    }
}
