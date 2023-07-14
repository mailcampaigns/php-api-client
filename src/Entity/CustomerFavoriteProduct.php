<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class CustomerFavoriteProduct implements EntityInterface
{
    private Customer $customer;
    private Product $product;

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $arr = [];

        if ($this->customer->getCustomerId()) {
            $arr['customer'] = $this->customer->toIri();
        }

        if ($this->product->getProductId()) {
            $arr['favorite_product'] = $this->product->toIri();
        }

        return $arr;
    }

    function toIri(): ?string
    {
        $customer = $this->getCustomer();
        $product = $this->getProduct();

        if (!$customer) {
            return null;
        }

        if (null === $customer->getCustomerId()) {
            return null;
        }

        if (null === $product->getProductId()) {
            return null;
        }

        return sprintf(
            '/customer_favorite_products/customer=%d;favoriteProduct=%d',
            $customer->getCustomerId(),
            $product->getProductId()
        );
    }

    public function __destruct()
    {
        unset($this->customer);
        unset($this->product);
    }
}
