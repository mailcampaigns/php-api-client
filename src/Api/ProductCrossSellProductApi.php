<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCrossSellProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductCrossSellProductApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param ProductCrossSellProduct|EntityInterface $entity
     * @return ProductCrossSellProduct
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductCrossSellProduct::class);
        $res = $this->post('product_cross_sell_products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_cross_sell_products/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return ProductCrossSellProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new ProductCrossSellProductCollection;

        $data = $this->get('product_cross_sell_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        if (isset($data['hydra:member'])) {
            $arr = $data['hydra:member'];
        } else if (isset($data) && is_array($data)) {
            $arr = $data;
        } else {
            $arr = [];
        }

        foreach ($arr as $crossSellData) {
            $crossSell = $this->toEntity($crossSellData);
            $collection->add($crossSell);
        }

        return $collection;
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
        $this->delete("product_cross_sell_products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductCrossSellProduct
     */
    public function toEntity(array $data): EntityInterface
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

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }
}
