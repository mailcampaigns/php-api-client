<?php

namespace MailCampaigns\ApiClient\Entity;

class CustomerFavoriteProduct implements EntityInterface
{
    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return CustomerFavoriteProduct
     */
    public function setCustomer(Customer $customer): CustomerFavoriteProduct
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return CustomerFavoriteProduct
     */
    public function setProduct(Product $product): CustomerFavoriteProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $arr = [];

        if ($this->customer instanceof Customer && $this->customer->getCustomerId()) {
            $arr['customer'] = $this->customer->toIri();
        }

        if ($this->product instanceof Product && $this->product->getProductId()) {
            $arr['favorite_product'] = $this->product->toIri();
        }

        return $arr;
    }

    /**
     * @inheritDoc
     */
    function toIri(): ?string
    {
        $customer = $this->getCustomer();
        $product = $this->getProduct();

        if (!$customer || !$product) {
            return null;
        }

        if (null === $customer->getCustomerId()) {
            return null;
        }

        if (null === $product->getProductId()) {
            return null;
        }

        return sprintf('/customer_favorite_products/customer=%d;favoriteProduct=%d',
            $customer->getCustomerId(), $product->getProductId());
    }

    public function __destruct()
    {
        unset($this->customer);
        unset($this->product);
    }
}
