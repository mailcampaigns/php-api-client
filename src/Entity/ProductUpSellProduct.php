<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductUpSellProduct implements EntityInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $upSellProduct;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductUpSellProduct
     */
    public function setProduct(Product $product): ProductUpSellProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getUpSellProduct(): Product
    {
        return $this->upSellProduct;
    }

    /**
     * @param Product $upSellProduct
     * @return ProductUpSellProduct
     */
    public function setUpSellProduct(Product $upSellProduct): ProductUpSellProduct
    {
        $this->upSellProduct = $upSellProduct;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->upSellProduct ? $this->upSellProduct->getTitle() : null;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        return [
            'product' => $this->product->toIri(),
            'up_sell_product' => $this->upSellProduct->toIri()
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getProduct() || !$this->getUpSellProduct()) {
            return '';
        }

        return sprintf('/product_up_sell_products/product=%d;upSellProduct=%d',
            $this->getProduct()->getProductId(), $this->getUpSellProduct()->getProductId());
    }
}
