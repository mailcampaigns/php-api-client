<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\QuoteProductCollection;
use MailCampaigns\ApiClient\ToJsonTrait;

class Quote implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;
    use ToJsonTrait;

    public function __construct(
        private ?int $quoteId = null,
        private ?string $quoteRef = null,
        private ?int $quantity = null,
        private ?float $priceCost = null,
        private ?float $priceExcl = null,
        private ?float $priceIncl = null,
        private ?float $shipmentPriceExcl = null,
        private ?float $shipmentPriceIncl = null,
        private ?float $discountExcl = null,
        private ?float $discountIncl = null,
        private ?int $productsCount = null,
        private ?int $productsQuantity = null,
        private ?string $discountRef = null,
        private ?string $discountType = null,
        private ?float $discountAmount = null,
        private ?float $discountPercentage = null,
        private ?string $discountShipment = null,
        private ?float $discountMinimumAmount = null,
        private ?string $discountCouponCode = null,
        private ?string $customerRef = null,
        private ?Customer $customer = null,
        private ?QuoteProductCollection $quoteProducts = new QuoteProductCollection(),
        private ?OrderCollection $orders = new OrderCollection(),
    ) {
        $this->createdAt = new DateTime();
    }

    public function getQuoteId(): ?int
    {
        return $this->quoteId;
    }

    public function setQuoteId(int $quoteId): self
    {
        $this->quoteId = $quoteId;
        return $this;
    }

    public function getQuoteRef(): ?string
    {
        return $this->quoteRef;
    }

    public function setQuoteRef(?string $quoteRef): self
    {
        $this->quoteRef = $quoteRef;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    public function setPriceCost(?float $priceCost): self
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    public function setPriceExcl(?float $priceExcl): self
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    public function setPriceIncl(?float $priceIncl): self
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    public function getShipmentPriceExcl(): ?float
    {
        return $this->shipmentPriceExcl;
    }

    public function setShipmentPriceExcl(?float $shipmentPriceExcl): self
    {
        $this->shipmentPriceExcl = $shipmentPriceExcl;
        return $this;
    }

    public function getShipmentPriceIncl(): ?float
    {
        return $this->shipmentPriceIncl;
    }

    public function setShipmentPriceIncl(?float $shipmentPriceIncl): self
    {
        $this->shipmentPriceIncl = $shipmentPriceIncl;
        return $this;
    }

    public function getDiscountExcl(): ?float
    {
        return $this->discountExcl;
    }

    public function setDiscountExcl(?float $discountExcl): self
    {
        $this->discountExcl = $discountExcl;
        return $this;
    }

    public function getDiscountIncl(): ?float
    {
        return $this->discountIncl;
    }

    public function setDiscountIncl(?float $discountIncl): self
    {
        $this->discountIncl = $discountIncl;
        return $this;
    }

    public function getProductsCount(): ?int
    {
        return $this->productsCount;
    }

    public function setProductsCount(?int $productsCount): self
    {
        $this->productsCount = $productsCount;
        return $this;
    }

    public function getProductsQuantity(): ?int
    {
        return $this->productsQuantity;
    }

    public function setProductsQuantity(?int $productsQuantity): self
    {
        $this->productsQuantity = $productsQuantity;
        return $this;
    }

    public function getDiscountRef(): ?string
    {
        return $this->discountRef;
    }

    public function setDiscountRef(?string $discountRef): self
    {
        $this->discountRef = $discountRef;
        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function setDiscountType(?string $discountType): self
    {
        $this->discountType = $discountType;
        return $this;
    }

    public function getDiscountAmount(): ?float
    {
        return $this->discountAmount;
    }

    public function setDiscountAmount(?float $discountAmount): self
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(?float $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    public function getDiscountShipment(): ?string
    {
        return $this->discountShipment;
    }

    public function setDiscountShipment(?string $discountShipment): self
    {
        $this->discountShipment = $discountShipment;
        return $this;
    }

    public function getDiscountMinimumAmount(): ?float
    {
        return $this->discountMinimumAmount;
    }

    public function setDiscountMinimumAmount(?float $discountMinimumAmount): self
    {
        $this->discountMinimumAmount = $discountMinimumAmount;
        return $this;
    }

    public function getDiscountCouponCode(): ?string
    {
        return $this->discountCouponCode;
    }

    public function setDiscountCouponCode(?string $discountCouponCode): self
    {
        $this->discountCouponCode = $discountCouponCode;
        return $this;
    }

    public function getCustomerRef(): ?string
    {
        return $this->customerRef;
    }

    public function setCustomerRef(?string $customerRef): self
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function getQuoteProducts(): QuoteProductCollection
    {
        return $this->quoteProducts;
    }

    public function setQuoteProducts(?iterable $quoteProducts): self
    {
        $this->quoteProducts = new QuoteProductCollection();

        if ($quoteProducts) {
            foreach ($quoteProducts as $data) {
                $quoteProduct = null;

                if (is_array($data)) {
                    if (isset($data['@id']) && is_string($data['@id'])) {
                        $quoteProduct = new QuoteProduct();

                        if (false !== preg_match('/\/quote_products\/(\d+)/', $data['@id'], $matches)) {
                            if (isset($matches[1])) {
                                $quoteProductId = (int)$matches[1];
                                $quoteProduct->setQuoteProductId($quoteProductId);
                            }
                        }

                        $quoteProduct
                            ->setBrandTitle($data['brand_title'])
                            ->setProductTitle($data['product_title'])
                            ->setBaseColli($data['base_colli'])
                            ->setBasePriceCost($data['base_price_cost'])
                            ->setBasePriceExcl($data['base_price_excl'])
                            ->setBasePriceIncl($data['base_price_incl'])
                            ->setQuantity($data['quantity'])
                            ->setDiscountPercentage($data['discount_percentage'])
                            ->setTaxRate($data['tax_rate'])
                            ->setPriceCost($data['price_cost'])
                            ->setPriceTax($data['price_tax'])
                            ->setPriceExcl($data['price_excl'])
                            ->setPriceIncl($data['price_incl'])
                            ->setDiscountExcl($data['discount_excl'])
                            ->setDiscountIncl($data['discount_incl'])
                            ->setAdditionalCostExcl($data['additional_cost_excl'])
                            ->setAdditionalCostIncl($data['additional_cost_incl'])
                            ->setBaseAdditionalCostExcl($data['additional_cost_excl'])
                            ->setBaseAdditionalCostIncl($data['additional_cost_incl'])
                            ->setLineRef($data['line_ref']);

                        // If a product is linked to this quote row (quote product) add
                        // product entity based on the product IRI.
                        if ($data['product']) {
                            $quoteProduct->setProduct(
                                $this->productIriToEntity($data['product'])
                            );
                        }
                    }
                } else {
                    if ($data instanceof QuoteProduct) {
                        $quoteProduct = $data;
                    }
                }

                $this->addQuoteProduct($quoteProduct);
            }
        }

        return $this;
    }

    public function addQuoteProduct(QuoteProduct $quoteProduct): self
    {
        if (!$this->quoteProducts->contains($quoteProduct)) {
            if ($quoteProduct->getQuote() !== $this) {
                $quoteProduct->setQuote($this);
            }

            $this->quoteProducts->add($quoteProduct);
        }

        return $this;
    }

    public function getOrders(): OrderCollection
    {
        return $this->orders;
    }

    public function setOrders(?iterable $orders): self
    {
        $this->orders = new OrderCollection();

        if ($orders) {
            foreach ($orders as $data) {
                $order = null;

                if ($data instanceof Order) {
                    $order = $data;
                } else {
                    if (is_string($data)) {
                        // Convert order IRI (string) to an Order entity.
                        $order = $this->iriToOrderEntity($data);
                    } else {
                        throw new LogicException('Order is neither an array nor an IRI!');
                    }
                }

                $this->addOrder($order);
            }
        }

        return $this;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            if ($order->getQuote() !== $this) {
                $order->setQuote($this);
            }

            $this->orders->add($order);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $order->setQuote(null);
            $this->orders->removeElement($order);
        }

        return $this;
    }

    public function getCustomerIri(): ?string
    {
        if (!$this->getCustomer() instanceof Customer) {
            return null;
        }

        return $this->getCustomer()->toIri();
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'quote_id' => $this->getQuoteId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'quote_ref' => $this->getQuoteRef(),
            'quantity' => $this->getQuantity(),
            'price_cost' => $this->getPriceCost(),
            'price_excl' => $this->getPriceExcl(),
            'price_incl' => $this->getPriceIncl(),
            'shipment_price_excl' => $this->getShipmentPriceExcl(),
            'shipment_price_incl' => $this->getShipmentPriceIncl(),
            'discount_excl' => $this->getDiscountExcl(),
            'discount_incl' => $this->getDiscountIncl(),
            'products_count' => $this->getProductsCount(),
            'products_quantity' => $this->getProductsQuantity(),
            'discount_ref' => $this->getDiscountRef(),
            'discount_type' => $this->getDiscountType(),
            'discount_amount' => $this->getDiscountAmount(),
            'discount_percentage' => $this->getDiscountPercentage(),
            'discount_shipment' => $this->getDiscountShipment(),
            'discount_minimum_amount' => $this->getDiscountMinimumAmount(),
            'discount_coupon_code' => $this->getDiscountCouponCode(),
            'customer_ref' => $this->getCustomerRef(),
            'customer' => $this->getCustomerIri(),
            'quote_products' => $this->getQuoteProducts()->toArray($operation),
            'orders' => $this->getOrders()->toArray($operation)
        ];
    }

    public function toIri(): ?string
    {
        if (null === $this->getQuoteId()) {
            return null;
        }

        return '/quotes/' . $this->getQuoteId();
    }

    public function __clone()
    {
        if ($this->createdAt !== null) {
            $this->createdAt = clone $this->createdAt;
        }

        if ($this->updatedAt !== null) {
            $this->updatedAt = clone $this->updatedAt;
        }

        if ($this->customer !== null) {
            $this->customer = clone $this->customer;
        }

        if ($this->orders !== null) {
            $this->orders = clone $this->orders;
        }

        if ($this->quoteProducts !== null) {
            $this->quoteProducts = clone $this->quoteProducts;
        }
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->customer);
        unset($this->quoteProducts);
        unset($this->orders);
    }

    private function productIriToEntity(string $iri): ?Product
    {
        if (false !== preg_match('/\/products\/(\d+)/', $iri, $matches)) {
            if (isset($matches[1])) {
                return (new Product())->setProductId((int)$matches[1]);
            }
        }

        return null;
    }

    private function iriToOrderEntity(string $iri): Order
    {
        $id = (int)str_replace('/orders/', '', $iri);
        return (new Order())->setOrderId($id);
    }
}
