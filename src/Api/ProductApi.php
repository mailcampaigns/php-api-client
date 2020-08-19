<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductCategoryProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;

class ProductApi extends AbstractApi
{
    /**
     * @param EntityInterface|Product $entity
     * @return Product
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof Product) {
            throw new InvalidArgumentException('Expected product entity!');
        }

        // Send request.
        $res = $this->post('products', $entity, ['content-type: application/json']);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return Product
     */
    public function getById(int $id): EntityInterface
    {
        return $this->toEntity($this->get("products/{$id}"));
    }

    /**
     * Tries to find a product by EAN (International Article Number), returns null
     * when no product was found with the given EAN.
     *
     * @param string $ean
     * @return Product|null
     */
    public function getByEan(string $ean): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('products', ['ean' => $ean])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Product was not found.
        return null;
    }
    
    /**
     * Tries to find a product by SKU (Stock Keeping Unit), returns null when no
     * product was found with the given SKU.
     *
     * @param string $sku
     * @return Product|null
     */
    public function getBySku(string $sku): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('products', ['sku' => $sku])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Product was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return ProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new ProductCollection;

        $parameters = [
            'page' => $page ?? $this->page,
            'itemsPerPage' => $perPage ?? $this->perPage,
            'order' => [
                'updated_at' => 'asc'
            ]
        ];

        $data = $this->get('products', $parameters);

        foreach ($data['hydra:member'] as $productData) {
            $product = $this->toEntity($productData);
            $collection->add($product);
        }

        return $collection;
    }

    /**
     * Updates a product.
     *
     * @param EntityInterface $entity
     * @return Product
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof Product) {
            throw new InvalidArgumentException('Expected product entity!');
        }

        /** @var Product $product */
        $product = $entity;

        $res = $this->put("products/{$product->getProductId()}", $product, [
            'content-type: application/json'
        ]);

        return $this->toEntity($res);
    }

    /**
     * Deletes a product by id.
     *
     * @param int $id
     * @return $this
     */
    public function deleteById(int $id): self
    {
        $this->delete("products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toEntity(array $data): EntityInterface
    {
        $categories = new ProductCategoryProductCollection($data['categories']);
        $relatedProducts = new ProductRelatedProductCollection($data['related_products']);
        $crossSellProducts = new ProductCrossSellProductCollection($data['cross_sell_products']);
        $upSellProducts = new ProductUpSellProductCollection($data['up_sell_products']);
        $volumeSellProducts = new ProductVolumeSellProductCollection($data['volume_sell_products']);
        $reviews = new ProductReviewCollection($data['reviews']);

        return (new Product)
            ->setProductId($data['product_id'])
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setVisibility($data['visibility'])
            ->setUrl($data['url'])
            ->setTitle($data['title'])
            ->setFullTitle($data['full_title'])
            ->setBrand($data['brand'])
            ->setDescription($data['description'])
            ->setContent($data['content'])
            ->setImage($data['image'])
            ->setArticleCode($data['article_code'])
            ->setEan($data['ean'])
            ->setSku($data['sku'])
            ->setPriceCost($data['price_cost'])
            ->setPriceExcl($data['price_excl'])
            ->setPriceIncl($data['price_incl'])
            ->setOldPriceExcl($data['old_price_excl'])
            ->setOldPriceIncl($data['old_price_incl'])
            ->setStockStatus($data['stock_status'])
            ->setStockCount($data['stock_count'])
            ->setTax($data['tax'])
            ->setTaxRate($data['tax_rate'])
            ->setCategories($categories)
            ->setRelatedProducts($relatedProducts)
            ->setCrossSellProducts($crossSellProducts)
            ->setUpSellProducts($upSellProducts)
            ->setVolumeSellProducts($volumeSellProducts)
            ->setReviews($reviews);
    }
}
