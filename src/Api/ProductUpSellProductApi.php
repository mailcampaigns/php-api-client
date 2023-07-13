<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductUpSellProduct;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductUpSellProductApi extends AbstractApi
{
    public function create(
        ProductUpSellProduct|EntityInterface $entity
    ): ProductUpSellProduct {
        assert($entity instanceof ProductUpSellProduct);

        return $this->toEntity(
            $this->post('product_up_sell_products', $entity)
        );
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById(int|string $id): ProductUpSellProduct
    {
        assert(is_string($id));
        return $this->toEntity($this->get("product_up_sell_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductUpSellProductCollection {
        $data = $this->get('product_up_sell_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, ProductUpSellProductCollection::class);
        assert($collection instanceof ProductUpSellProductCollection);

        return $collection;
    }

    public function update(
        ProductUpSellProduct|EntityInterface $entity
    ): ProductUpSellProduct {
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
        $this->delete("product_up_sell_products/$id");

        return $this;
    }

    public function toEntity(array $data): ProductUpSellProduct
    {
        $product = $this->iriToProduct($data['product']);
        $linkedProduct = $this->iriToProduct($data['linked_product']);

        return (new ProductUpSellProduct)
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
