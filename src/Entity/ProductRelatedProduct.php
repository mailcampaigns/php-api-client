<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductRelatedProduct implements EntityInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $relatedProduct;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductRelatedProduct
     */
    public function setProduct(Product $product): ProductRelatedProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getRelatedProduct(): Product
    {
        return $this->relatedProduct;
    }

    /**
     * @param Product $relatedProduct
     * @return ProductRelatedProduct
     */
    public function setRelatedProduct(Product $relatedProduct): ProductRelatedProduct
    {
        $this->relatedProduct = $relatedProduct;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->relatedProduct ? $this->relatedProduct->getTitle() : null;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        $arr = [
            'related_product' => $this->relatedProduct->toIri()
        ];

        if ($this->product instanceof Product && $this->product->getProductId()) {
            $arr['product'] = $this->product->toIri();
        }

        return $arr;
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getProduct() || !$this->getRelatedProduct()) {
            return '';
        }

        return sprintf('/product_related_products/product=%d;relatedProduct=%d',
            $this->getProduct()->getProductId(), $this->getRelatedProduct()->getProductId());
    }
}
