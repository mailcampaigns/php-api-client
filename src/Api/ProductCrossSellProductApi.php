<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCrossSellProduct;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductCrossSellProductApi extends AbstractApi
{
    public function create(
        ProductCrossSellProduct|EntityInterface $entity
    ): ProductCrossSellProduct {
        assert($entity instanceof ProductCrossSellProduct);
        return $this->toEntity($this->post('product_cross_sell_products', $entity));
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById(int|string $id): ProductCrossSellProduct
    {
        assert(is_string($id));
        return $this->toEntity($this->get("product_cross_sell_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductCrossSellProductCollection {
        $data = $this->get('product_cross_sell_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection(
            $data,
            ProductCrossSellProductCollection::class
        );

        assert($collection instanceof ProductCrossSellProductCollection);

        return $collection;
    }

    public function update(
        ProductCrossSellProduct|EntityInterface $entity
    ): ProductCrossSellProduct {
        throw new ApiException(
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
        $this->delete("product_cross_sell_products/$id");

        return $this;
    }

    public function toEntity(array $data): ProductCrossSellProduct
    {
        $product = $this->iriToProduct($data['product']);
        $linkedProduct = $this->iriToProduct($data['linked_product']);

        return (new ProductCrossSellProduct)
            ->setProduct($product)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        return (new Product)->setProductId(
            (int)str_replace('/products/', '', $iri)
        );
    }
}
