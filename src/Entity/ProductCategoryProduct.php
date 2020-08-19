<?php

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\Api\ApiInterface;

/**
 * This entity connects products and product categories.
 */
class ProductCategoryProduct implements EntityInterface
{
    /**
     * @var ProductCategory
     */
    protected $productCategory;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @return ProductCategory
     */
    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    /**
     * @param ProductCategory $productCategory
     * @return ProductCategoryProduct
     */
    public function setProductCategory(ProductCategory $productCategory): self
    {
        $this->productCategory = $productCategory;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductCategoryProduct
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        if ($operation !== ApiInterface::OPERATION_PUT) {
            return [
                'product_category' => $this->productCategory->toArray($operation)
            ];
        } else {
            return [
                'product' => $this->product->toIri(),
                'product_category' => $this->productCategory->toIri()
            ];
        }
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getProductCategory() || !$this->getProduct()) {
            return '';
        }

        return sprintf('/product_category_products/product_category=%d;product=%d',
            $this->getProductCategory()->getProductCategoryId(), $this->getProduct()->getProductId());
    }
}
