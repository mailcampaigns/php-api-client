<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\ToJsonTrait;

/**
 * This trait should be used for all product to product relations.
 */
trait LinkedProductTrait
{
    use ToJsonTrait;

    protected ?Product $product;
    protected ?Product $linkedProduct;

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getLinkedProduct(): ?Product
    {
        return $this->linkedProduct;
    }

    public function setLinkedProduct(?Product $linkedProduct): self
    {
        $this->linkedProduct = $linkedProduct;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
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

    public function toIri(): ?string
    {
        $product = $this->getProduct();
        $linkedProduct = $this->getLinkedProduct();

        if (!$product) {
            return null;
        }

        if (null === $product->getProductId()) {
            return null;
        }

        if (null === $linkedProduct->getProductId()) {
            return null;
        }

        return sprintf(
            '%s/product=%d;linkedProduct=%d',
            self::$endpoint,
            $product->getProductId(),
            $linkedProduct->getProductId()
        );
    }
}
