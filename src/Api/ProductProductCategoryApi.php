<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCategory;
use MailCampaigns\ApiClient\Entity\ProductProductCategory;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductProductCategoryApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param ProductProductCategory|EntityInterface $entity
     * @return ProductProductCategory
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductProductCategory::class);
        $res = $this->post('product_product_categories', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;productCategory=2
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_product_categories/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return ProductProductCategoryCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('product_product_categories', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, ProductProductCategoryCollection::class);
    }


    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported! Either create or delete this item.');
    }

    /**
     * @inheritDoc
     * @param string $id In this format: product=1;productCategory=2
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("product_product_categories/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductProductCategory
     */
    public function toEntity(array $data): EntityInterface
    {
        $product = $this->iriToProduct($data['product']);
        $productCategory = $this->toProductCategory($data['product_category']);

        return (new ProductProductCategory)
            ->setProduct($product)
            ->setProductCategory($productCategory);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }

    protected function toProductCategory(array $data): ProductCategory
    {
        return (new ProductCategory)
            ->setProductCategoryId($data['product_category_id'])
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setTitle($data['title']);

    }
}
