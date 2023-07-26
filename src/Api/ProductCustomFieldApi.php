<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCustomField;

class ProductCustomFieldApi extends AbstractApi implements CustomFieldApiInterface
{
    public function create(ProductCustomField|EntityInterface $entity): ProductCustomField
    {
        assert($entity instanceof ProductCustomField);
        return $this->toEntity($this->post('product_custom_fields', $entity));
    }

    public function getById($id): ProductCustomField
    {
        return $this->toEntity($this->get("product_custom_fields/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductCustomFieldCollection {
        $data = $this->get('product_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, ProductCustomFieldCollection::class);
        assert($collection instanceof ProductCustomFieldCollection);

        return $collection;
    }

    public function update(
        ProductCustomField|EntityInterface $entity
    ): ProductCustomField {
        assert($entity instanceof ProductCustomField);

        return $this->toEntity(
            $this->put(
                "product_custom_fields/{$entity->getCustomFieldId()}",
                $entity
            )
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("product_custom_fields/$id");
        return $this;
    }

    public function toEntity(array $data): ProductCustomField
    {
        $customField = (new ProductCustomField())
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked product.
        if (isset($data['product']) && is_string($data['product'])) {
            if (false !== preg_match('/\/products\/(\d+)/', $data['product'], $matches)) {
                if (isset($matches[1])) {
                    $product = (new Product())->setProductId((int)$matches[1]);
                    $customField->setProduct($product);
                }
            }
        }

        return $customField;
    }
}
