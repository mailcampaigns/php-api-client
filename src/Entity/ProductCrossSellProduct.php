<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductCrossSellProduct implements EntityInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $crossSellProduct;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductCrossSellProduct
     */
    public function setProduct(Product $product): ProductCrossSellProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getCrossSellProduct(): Product
    {
        return $this->crossSellProduct;
    }

    /**
     * @param Product $crossSellProduct
     * @return ProductCrossSellProduct
     */
    public function setCrossSellProduct(Product $crossSellProduct): ProductCrossSellProduct
    {
        $this->crossSellProduct = $crossSellProduct;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->crossSellProduct ? $this->crossSellProduct->getTitle() : null;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        return [
            'product' => $this->product->toIri(),
            'cross_sell_product' => $this->crossSellProduct->toIri()
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getProduct() || !$this->getCrossSellProduct()) {
            return '';
        }

        return sprintf('/product_cross_sell_products/product=%d;crossSellProduct=%d',
            $this->getProduct()->getProductId(), $this->getCrossSellProduct()->getProductId());
    }
}
