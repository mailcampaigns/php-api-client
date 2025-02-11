<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\ProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;

class ProductApi implements ApiInterface
{
    use ApiTrait;

    /**
     * @api
     */
    public const ORDERABLE_PARAMS = [
        'product_id',
        'created_at',
        'updated_at'
    ];

    public const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    public function create(Product|EntityInterface $entity): Product
    {
        assert($entity instanceof Product);
        return $this->toEntity($this->post('products', $entity));
    }

    /**
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * {@inheritDoc}
     */
    public function getById(int|string $id, ?array $propertyFilter = null): Product
    {
        $path = "products/$id";

        if (null !== $propertyFilter) {
            $path .= '?';

            foreach ($propertyFilter as $idx => $property) {
                if ($idx !== 0) {
                    $path .= '&';
                }

                $path .= 'properties[]=' . $property;
            }
        }

        return $this->toEntity($this->get($path));
    }

    /**
     * Tries to find a product by article code, returns null when no product was found.
     *
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getByArticleCode(
        string $articleCode,
        ?array $propertyFilter = null
    ): ?Product {
        $parameters = ['article_code' => $articleCode];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->handleSingleItemResponse(
            $this->get('products', $parameters)
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    /**
     * @param string[] $articleCodes A list of article codes to retrieve products by.
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getByArticleCodes(
        array $articleCodes,
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $propertyFilter = null
    ): ProductCollection {
        $parameters = [
            'article_code' => $articleCodes,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->get('products', $parameters);

        $collection = $this->toCollection($data, ProductCollection::class);
        assert($collection instanceof ProductCollection);

        return $collection;
    }

    /**
     * Tries to find a product by EAN (International Article Number), returns null
     * when no product was found with the given product EAN.
     *
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getByEan(string $ean, ?array $propertyFilter = null): ?Product
    {
        $parameters = ['ean' => $ean];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->handleSingleItemResponse(
            $this->get('products', $parameters)
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    /**
     * @param string[] $eans A list of EANs to retrieve products by.
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getByEans(
        array $eans,
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $propertyFilter = null
    ): ProductCollection {
        $parameters = [
            'ean' => $eans,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->get('products', $parameters);

        $collection = $this->toCollection($data, ProductCollection::class);
        assert($collection instanceof ProductCollection);

        return $collection;
    }

    /**
     * Tries to find a product by SKU (Stock Keeping Unit), returns null when no
     * product was found with the given product SKU.
     *
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getBySku(string $sku, ?array $propertyFilter = null): ?Product
    {
        $parameters = ['sku' => $sku];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->handleSingleItemResponse(
            $this->get('products', $parameters)
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    /**
     * @param string[] $skus A list of SKUs to retrieve products by.
     * @param int|null $page Defaults to first page.
     * @param int|null $perPage Number of resources to retrieve. If not supplied, uses
     *  default number of resources per page.
     * @param string[]|null $order Overrides default order to sort results on.
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * @throws ApiClientException
     * @api
     */
    public function getBySkus(
        array $skus,
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $propertyFilter = null
    ): ProductCollection {
        $parameters = [
            'sku' => $skus,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $collection = $this->toCollection(
            $this->get('products', $parameters),
            ProductCollection::class
        );

        assert($collection instanceof ProductCollection);

        return $collection;
    }

    /**
     * @param string[]|null $order Overrides default order to sort results on.
     * @param string[]|null $propertyFilter Optionally set properties to return in response,
     *  will return all if kept empty (null).
     * {@inheritDoc}
     */
    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $propertyFilter = null
    ): ProductCollection {
        $parameters = [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ];

        // If set, add property filter.
        if (null !== $propertyFilter) {
            $parameters['properties'] = $propertyFilter;
        }

        $data = $this->get('products', $parameters);

        $collection = $this->toCollection($data, ProductCollection::class);
        assert($collection instanceof ProductCollection);

        return $collection;
    }

    public function update(Product|EntityInterface $entity): Product
    {
        assert($entity instanceof Product);

        return $this->toEntity(
            $this->put("products/{$entity->getProductId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("products/$id");
        return $this;
    }

    public function toEntity(array $data): Product
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
                    $parent = (new Product())->setProductId((int)$matches[1]);
                }
            }
        }

        return (new Product())
            ->setProductId($data['product_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at'] ?? null))
            ->setUpdatedAt($this->toDtObject($data['updated_at'] ?? null))
            ->setIsVisible($data['is_visible'] ?? null)
            ->setVisibility($data['visibility'] ?? null)
            ->setUrl($data['url'] ?? null)
            ->setTitle($data['title'] ?? null)
            ->setFullTitle($data['full_title'] ?? null)
            ->setBrand($data['brand'] ?? null)
            ->setDescription($data['description'] ?? null)
            ->setContent($data['content'] ?? null)
            ->setImage($data['image'] ?? null)
            ->setArticleCode($data['article_code'] ?? null)
            ->setEan($data['ean'] ?? null)
            ->setSku($data['sku'] ?? null)
            ->setPriceCost($data['price_cost'] ?? null)
            ->setPriceExcl($data['price_excl'] ?? null)
            ->setPriceIncl($data['price_incl'] ?? null)
            ->setOldPriceExcl($data['old_price_excl'] ?? null)
            ->setOldPriceIncl($data['old_price_incl'] ?? null)
            ->setDiscountPercentage($data['discount_percentage'] ?? null)
            ->setStockStatus($data['stock_status'] ?? null)
            ->setStockCount($data['stock_count'] ?? null)
            ->setTax($data['tax'] ?? null)
            ->setTaxRate($data['tax_rate'] ?? null)
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
