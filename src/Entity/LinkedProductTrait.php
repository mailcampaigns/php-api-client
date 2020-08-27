<?php

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\Api\ApiInterface;

/**
 * This trait should be used for all product to product relations.
 */
trait LinkedProductTrait
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $linkedProduct;

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getLinkedProduct(): Product
    {
        return $this->linkedProduct;
    }

    /**
     * @param Product $linkedProduct
     * @return $this
     */
    public function setLinkedProduct(Product $linkedProduct): self
    {
        $this->linkedProduct = $linkedProduct;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $res = [];

        if ($isRoot) {
            $res['product'] = $this->product->toIri();
        }

        if ($operation === ApiInterface::OPERATION_GET && false === $isRoot) {
            $linkedProduct = $this->linkedProduct->toArray($operation);
        } else {
            $linkedProduct = $this->linkedProduct->toIri();
        }

        $res['linked_product'] = $linkedProduct;

        return $res;
    }

    /**
     * @inheritDoc
     */
    function toIri(): ?string
    {
        $product = $this->getProduct();
        $linkedProduct = $this->getLinkedProduct();

        if (!$product || !$linkedProduct) {
            return null;
        }

        if (null === $product->getProductId()) {
            return null;
        }

        if (null === $linkedProduct->getProductId()) {
            return null;
        }

        return sprintf('%s/product=%d;linkedProduct=%d', self::$endpoint,
            $product->getProductId(), $linkedProduct->getProductId());
    }
}
