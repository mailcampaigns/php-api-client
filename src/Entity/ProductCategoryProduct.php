<?php

namespace MailCampaigns\ApiClient\Entity;

/**
 * This entity connects products and product categories.
 */
class ProductCategoryProduct implements EntityInterface
{
    /**
     * @var string
     */
    protected $iri;

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
    function toArray(): array
    {
        // todo: ??
        return [];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        // todo: combination of product and category iri's?
        return $this->iri ?? '/products/' . (int)$this->product->getProductId();
    }
}
