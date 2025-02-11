<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductRelatedProduct;

class ProductRelatedProductApi implements ApiInterface
{
    use ApiTrait;

    public function create(
        ProductRelatedProduct|EntityInterface $entity
    ): ProductRelatedProduct {
        assert($entity instanceof ProductRelatedProduct);
        return $this->toEntity($this->post('product_related_products', $entity));
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById(int|string $id): ProductRelatedProduct
    {
        assert(is_string($id));
        return $this->toEntity($this->get("product_related_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductRelatedProductCollection {
        $data = $this->get('product_related_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection(
            $data,
            ProductRelatedProductCollection::class
        );

        assert($collection instanceof ProductRelatedProductCollection);

        return $collection;
    }

    /**
     * @throws ApiClientException
     * {@inheritDoc}
     */
    public function update(
        ProductRelatedProduct|EntityInterface $entity
    ): ProductRelatedProduct {
        throw new ApiClientException(
            'Operation not supported! Either create or delete this item.'
        );
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function deleteById(int|string $id): self
    {
        assert(is_string($id));
        $this->delete("product_related_products/$id");

        return $this;
    }

    public function toEntity(array $data): ProductRelatedProduct
    {
        $product = $this->iriToProduct($data['product']);
        $linkedProduct = $this->iriToProduct($data['linked_product']);

        return (new ProductRelatedProduct())
            ->setProduct($product)
            ->setLinkedProduct($linkedProduct);
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
}
