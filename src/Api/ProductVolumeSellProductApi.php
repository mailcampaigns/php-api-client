<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductVolumeSellProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductVolumeSellProductApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param ProductVolumeSellProduct|EntityInterface $entity
     * @return ProductVolumeSellProduct
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductVolumeSellProduct::class);
        $res = $this->post('product_volume_sell_products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_volume_sell_products/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return ProductVolumeSellProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('product_volume_sell_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, ProductVolumeSellProductCollection::class);
    }

    /**
     * {@inheritDoc}
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported! Either create or delete this item.');
    }

    /**
     * @inheritDoc
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("product_volume_sell_products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductVolumeSellProduct
     */
    public function toEntity(array $data): EntityInterface
    {
        $product = $this->iriToProduct($data['product']);
        $linkedProduct = $this->iriToProduct($data['linked_product']);

        return (new ProductVolumeSellProduct)
            ->setProduct($product)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }
}
