<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\Api\ApiInterface;

/**
 * This entity connects a product with product categories.
 */
class ProductProductCategory implements EntityInterface
{
    private ?Product $product;
    private ?ProductCategory $productCategory;

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    public function setProductCategory(
        ?ProductCategory $productCategory
    ): self {
        $this->productCategory = $productCategory;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        if ($operation === ApiInterface::OPERATION_GET) {
            $productCategory = $this->productCategory->toArray($operation);
        } else {
            $productCategory = $this->productCategory->toIri();
        }

        return array_filter([
            'product' => $this->product->toIri(),
            'product_category' => $productCategory
        ]);
    }

    public function toIri(): ?string
    {
        $product = $this->getProduct();
        $category = $this->getProductCategory();

        if (!$product || !$category) {
            return null;
        }

        if (null === $product->getProductId()) {
            return null;
        }

        if (null === $category->getProductCategoryId()) {
            return null;
        }

        return sprintf(
            '/product_product_categories/product=%d;productCategory=%d',
            $product->getProductId(),
            $category->getProductCategoryId()
        );
    }

    public function __destruct()
    {
        unset($this->product);
        unset($this->productCategory);
    }
}
