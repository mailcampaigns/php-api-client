<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
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
    const ORDERABLE_PARAMS = [
        'product_id',
        'created_at',
        'updated_at'
    ];

    const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    /**
     * {@inheritDoc}
     * @param Product|EntityInterface $entity
     * @return Product
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, Product::class);
        $res = $this->post('products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return Product
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("products/{$id}"));
    }

    /**
     * Tries to find a product by article code, returns null when no
     * product was found with the given article code.
     *
     * @param string $articleCode
     * @return Product|null
     */
    public function getByArticleCode(string $articleCode): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('products', ['article_code' => $articleCode])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Product was not found.
        return null;
    }

    public function getByArticleCodes(array $articleCodes, ?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('products', [
            'article_code' => $articleCodes,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, ProductCollection::class);
    }

    /**
     * Tries to find a product by EAN (International Article Number), returns null
     * when no product was found with the given product EAN.
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

    public function getByEans(array $eans, ?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('products', [
            'ean' => $eans,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, ProductCollection::class);
    }

    /**
     * Tries to find a product by SKU (Stock Keeping Unit), returns null when no
     * product was found with the given product SKU.
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
    public function getCollection(?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, ProductCollection::class);
    }

    /**
     * {@inheritDoc}
     * @param Product|EntityInterface $entity
     * @return Product
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, Product::class);

        $res = $this->put("products/{$entity->getProductId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return Product
     */
    public function toEntity(array $data): EntityInterface
    {
        $parent = null;

        $categories = new ProductProductCategoryCollection($data['categories'] ?? []);
        $relatedProducts = new ProductRelatedProductCollection($data['related_products'] ?? []);
        $crossSellProducts = new ProductCrossSellProductCollection($data['cross_sell_products'] ?? []);
        $upSellProducts = new ProductUpSellProductCollection($data['up_sell_products'] ?? []);
        $volumeSellProducts = new ProductVolumeSellProductCollection($data['volume_sell_products'] ?? []);
        $reviews = new ProductReviewCollection($data['reviews'] ?? []);
        $customFields = new ProductCustomFieldCollection($data['custom_fields'] ?? []);
        $children = new ProductCollection($data['children'] ?? []);

        // Set parent product.
        if (isset($data['parent']) && is_string($data['parent'])) {
            if (false !== preg_match('/\/products\/(\d+)/', $data['parent'], $matches)) {
                if (isset($matches[1])) {
                    $parent = (new Product)->setProductId((int)$matches[1]);
                }
            }
        }

        return (new Product)
            ->setProductId($data['product_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at'] ?? null))
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
            ->setDiscountPercentage($data['discount_percentage'])
            ->setStockStatus($data['stock_status'])
            ->setStockCount($data['stock_count'])
            ->setTax($data['tax'])
            ->setTaxRate($data['tax_rate'])
            ->setCategories($categories)
            ->setRelatedProducts($relatedProducts)
            ->setCrossSellProducts($crossSellProducts)
            ->setUpSellProducts($upSellProducts)
            ->setVolumeSellProducts($volumeSellProducts)
            ->setReviews($reviews)
            ->setCustomFields($customFields)
            ->setChildren($children)
            ->setParent($parent);
    }
}
