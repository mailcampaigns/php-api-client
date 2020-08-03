<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductVolumeSellProduct implements EntityInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $volumeSellProduct;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductVolumeSellProduct
     */
    public function setProduct(Product $product): ProductVolumeSellProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getVolumeSellProduct(): Product
    {
        return $this->volumeSellProduct;
    }

    /**
     * @param Product $volumeSellProduct
     * @return ProductVolumeSellProduct
     */
    public function setVolumeSellProduct(Product $volumeSellProduct): ProductVolumeSellProduct
    {
        $this->volumeSellProduct = $volumeSellProduct;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->volumeSellProduct ? $this->volumeSellProduct->getTitle() : null;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        return [
            'product' => $this->product->toIri(),
            'volume_sell_product' => $this->volumeSellProduct->toIri()
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getProduct() || !$this->getVolumeSellProduct()) {
            return '';
        }

        return sprintf('/product_volume_sell_products/product=%d;volumeSellProduct=%d',
            $this->getProduct()->getProductId(), $this->getVolumeSellProduct()->getProductId());
    }
}
