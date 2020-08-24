<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductUpSellProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Exception\ApiException;

class ProductUpSellProductApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param ProductUpSellProduct|EntityInterface $entity
     * @return ProductUpSellProduct
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductUpSellProduct::class);
        $res = $this->post('product_up_sell_products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: product=1;linkedProduct=2
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_up_sell_products/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return ProductUpSellProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new ProductUpSellProductCollection;

        $data = $this->get('product_up_sell_products', [
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

        foreach ($arr as $upSellData) {
            $upSell = $this->toEntity($upSellData);
            $collection->add($upSell);
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
        $this->delete("product_up_sell_products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductUpSellProduct
     */
    public function toEntity(array $data): EntityInterface
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

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }
}
