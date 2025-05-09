<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCategory;
use MailCampaigns\ApiClient\Entity\ProductProductCategory;

class ProductProductCategoryApi implements ApiInterface
{
    use ApiTrait;

    public function create(
        ProductProductCategory|EntityInterface $entity
    ): ProductProductCategory {
        assert($entity instanceof ProductProductCategory);

        return $this->toEntity(
            $this->post('product_product_categories', $entity)
        );
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;productCategory=2
     */
    public function getById(int|string $id): ProductProductCategory
    {
        assert(is_string($id));
        return $this->toEntity($this->get("product_product_categories/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductProductCategoryCollection {
        $data = $this->get('product_product_categories', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection(
            $data,
            ProductProductCategoryCollection::class
        );

        assert($collection instanceof ProductProductCategoryCollection);

        return $collection;
    }

    /**
     * @throws ApiClientException
     * {@inheritDoc}
     */
    public function update(
        ProductProductCategory|EntityInterface $entity
    ): ProductProductCategory {
        throw new ApiClientException(
            'Operation not supported! Either create or delete this item.'
        );
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;productCategory=2
     */
    public function deleteById(int|string $id): self
    {
        $this->delete("product_product_categories/$id");
        return $this;
    }

    public function toEntity(array $data): ProductProductCategory
    {
        $product = $this->iriToProduct($data['product']);
        $productCategory = $this->toProductCategory($data['product_category']);

        return (new ProductProductCategory())
            ->setProduct($product)
            ->setProductCategory($productCategory);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        return (new Product())->setProductId(
            (int)str_replace('/products/', '', $iri)
        );
    }

    protected function toProductCategory(array $data): ProductCategory
    {
        return (new ProductCategory())
            ->setProductCategoryId($data['product_category_id'])
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setTitle($data['title']);
    }
}
