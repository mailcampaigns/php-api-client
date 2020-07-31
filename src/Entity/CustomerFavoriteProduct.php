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
     * @return Customer
     */
    public function getCustomer(): Customer
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
    function toArray(?string $operation = null): array
    {
        return [
            'customer' => $this->customer->toIri(),
            'product' => $this->product->toIri()
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (!$this->getCustomer() || !$this->getProduct()) {
            return '';
        }

        return sprintf('/customer_favorite_products/customer=%d;favoriteProduct=%d',
            $this->getCustomer()->getCustomerId(), $this->getProduct()->getProductId());
    }
}
