<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductVolumeSellProduct;

class ProductVolumeSellProductApi implements ApiInterface
{
    use ApiTrait;

    public function create(
        ProductVolumeSellProduct|EntityInterface $entity
    ): ProductVolumeSellProduct {
        assert($entity instanceof ProductVolumeSellProduct);

        return $this->toEntity(
            $this->post('product_volume_sell_products', $entity)
        );
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById(int|string $id): ProductVolumeSellProduct
    {
        assert(is_string($id));
        return $this->toEntity($this->get("product_volume_sell_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): ProductVolumeSellProductCollection {
        $data = $this->get('product_volume_sell_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, ProductVolumeSellProductCollection::class);
        assert($collection instanceof ProductVolumeSellProductCollection);

        return $collection;
    }

    /**
     * @throws ApiClientException
     * {@inheritDoc}
     */
    public function update(
        ProductVolumeSellProduct|EntityInterface $entity
    ): ProductVolumeSellProduct {
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
        $this->delete("product_volume_sell_products/$id");

        return $this;
    }

    public function toEntity(array $data): ProductVolumeSellProduct
    {
        $product = $this->iriToProduct($data['product']);
        $linkedProduct = $this->iriToProduct($data['linked_product']);

        return (new ProductVolumeSellProduct())
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
