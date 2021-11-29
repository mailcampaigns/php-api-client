<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\QuoteProductCollection;

class Quote implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    /**
     * The unique numeric identifier for the quote.
     *
     * @var int
     */
    protected $quoteId;

    /**
     * The date and time when the quote was created.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * The date and time when the quote was last updated.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Quote reference.
     *
     * @var string
     */
    protected $quoteRef;

    /**
     * The total quantity of the quote.
     *
     * @var int
     */
    protected $quantity;

    /**
     * The total cost price of the quote.
     *
     * @var float
     */
    protected $priceCost;

    /**
     * The total price excluding tax.
     *
     * @var float
     */
    protected $priceExcl;

    /**
     * The total price including tax.
     *
     * @var float
     */
    protected $priceIncl;

    /**
     * Shipment price excl. tax.
     *
     * @var float
     */
    protected $shipmentPriceExcl;

    /**
     * Shipment price incl. tax.
     *
     * @var float
     */
    protected $shipmentPriceIncl;

    /**
     * The total discount amount excluding tax.
     *
     * @var float
     */
    protected $discountExcl;

    /**
     * The total discount amount including tax.
     *
     * @var float
     */
    protected $discountIncl;

    /**
     * The total count of products in this quote.
     *
     * @var int
     */
    protected $productsCount;

    /**
     * The total quantity of product in this quote.
     *
     * @var int
     */
    protected $productsQuantity;

    /**
     * The unique (external) identifier that links to the discount code used for this quote.
     *
     * @var string
     */
    protected $discountRef;

    /**
     * The type of discount that has been applied. (Example: "amount")
     *
     * @var string
     */
    protected $discountType;

    /**
     * The total amount of the discount.
     *
     * @var float
     */
    protected $discountAmount;

    /**
     * The total percentage of the discount.
     *
     * @var float
     */
    protected $discountPercentage;

    /**
     * The type of discount applied to the shipment method. (Examples: "default", "discount", "free")
     *
     * @var string
     */
    protected $discountShipment;

    /**
     * The minimum quote amount to allow the discount to be applied to.
     *
     * @var float
     */
    protected $discountMinimumAmount;

    /**
     * Discount coupon code used (Example: "CP-258-151").
     *
     * @var string
     */
    protected $discountCouponCode;

    /**
     * Customer reference (external).
     *
     * @var string
     */
    protected $customerRef;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * The products in this quote.
     *
     * @var QuoteProductCollection
     */
    protected $quoteProducts;

    /**
     * @var OrderCollection
     */
    protected $orders;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->quoteProducts = new QuoteProductCollection;
        $this->orders = new OrderCollection;
    }

    /**
     * @return int
     */
    public function getQuoteId(): ?int
    {
        return $this->quoteId;
    }

    /**
     * @param int $quoteId
     * @return Quote
     */
    public function setQuoteId(int $quoteId): Quote
    {
        $this->quoteId = $quoteId;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuoteRef(): ?string
    {
        return $this->quoteRef;
    }

    /**
     * @param string|null $quoteRef
     * @return Quote
     */
    public function setQuoteRef(?string $quoteRef): Quote
    {
        $this->quoteRef = $quoteRef;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return Quote
     */
    public function setQuantity(?int $quantity): Quote
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    /**
     * @param float|null $priceCost
     * @return Quote
     */
    public function setPriceCost(?float $priceCost): Quote
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    /**
     * @param float|null $priceExcl
     * @return Quote
     */
    public function setPriceExcl(?float $priceExcl): Quote
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    /**
     * @param float|null $priceIncl
     * @return Quote
     */
    public function setPriceIncl(?float $priceIncl): Quote
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getShipmentPriceExcl(): ?float
    {
        return $this->shipmentPriceExcl;
    }

    /**
     * @param float|null $shipmentPriceExcl
     * @return Quote
     */
    public function setShipmentPriceExcl(?float $shipmentPriceExcl): Quote
    {
        $this->shipmentPriceExcl = $shipmentPriceExcl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getShipmentPriceIncl(): ?float
    {
        return $this->shipmentPriceIncl;
    }

    /**
     * @param float|null $shipmentPriceIncl
     * @return Quote
     */
    public function setShipmentPriceIncl(?float $shipmentPriceIncl): Quote
    {
        $this->shipmentPriceIncl = $shipmentPriceIncl;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountExcl(): ?float
    {
        return $this->discountExcl;
    }

    /**
     * @param float|null $discountExcl
     * @return Quote
     */
    public function setDiscountExcl(?float $discountExcl): Quote
    {
        $this->discountExcl = $discountExcl;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountIncl(): ?float
    {
        return $this->discountIncl;
    }

    /**
     * @param float|null $discountIncl
     * @return Quote
     */
    public function setDiscountIncl(?float $discountIncl): Quote
    {
        $this->discountIncl = $discountIncl;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductsCount(): ?int
    {
        return $this->productsCount;
    }

    /**
     * @param int|null $productsCount
     * @return Quote
     */
    public function setProductsCount(?int $productsCount): Quote
    {
        $this->productsCount = $productsCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductsQuantity(): ?int
    {
        return $this->productsQuantity;
    }

    /**
     * @param int|null $productsQuantity
     * @return Quote
     */
    public function setProductsQuantity(?int $productsQuantity): Quote
    {
        $this->productsQuantity = $productsQuantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountRef(): ?string
    {
        return $this->discountRef;
    }

    /**
     * @param string|null $discountRef
     * @return Quote
     */
    public function setDiscountRef(?string $discountRef): Quote
    {
        $this->discountRef = $discountRef;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    /**
     * @param string|null $discountType
     * @return Quote
     */
    public function setDiscountType(?string $discountType): Quote
    {
        $this->discountType = $discountType;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountAmount(): ?float
    {
        return $this->discountAmount;
    }

    /**
     * @param float|null $discountAmount
     * @return Quote
     */
    public function setDiscountAmount(?float $discountAmount): Quote
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    /**
     * @param float|null $discountPercentage
     * @return Quote
     */
    public function setDiscountPercentage(?float $discountPercentage): Quote
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountShipment(): ?string
    {
        return $this->discountShipment;
    }

    /**
     * @param string|null $discountShipment
     * @return Quote
     */
    public function setDiscountShipment(?string $discountShipment): Quote
    {
        $this->discountShipment = $discountShipment;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountMinimumAmount(): ?float
    {
        return $this->discountMinimumAmount;
    }

    /**
     * @param float|null $discountMinimumAmount
     * @return Quote
     */
    public function setDiscountMinimumAmount(?float $discountMinimumAmount): Quote
    {
        $this->discountMinimumAmount = $discountMinimumAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountCouponCode(): ?string
    {
        return $this->discountCouponCode;
    }

    /**
     * @param string|null $discountCouponCode
     * @return Quote
     */
    public function setDiscountCouponCode(?string $discountCouponCode): Quote
    {
        $this->discountCouponCode = $discountCouponCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRef(): ?string
    {
        return $this->customerRef;
    }

    /**
     * @param string|null $customerRef
     * @return Quote
     */
    public function setCustomerRef(?string $customerRef): Quote
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     * @return Quote
     */
    public function setCustomer(?Customer $customer): Quote
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return QuoteProductCollection
     */
    public function getQuoteProducts(): QuoteProductCollection
    {
        return $this->quoteProducts;
    }

    /**
     * @param iterable|QuoteProductCollection|null $quoteProducts
     * @return Quote
     */
    public function setQuoteProducts(?iterable $quoteProducts): Quote
    {
        $this->quoteProducts = new QuoteProductCollection;

        if ($quoteProducts) {
            foreach ($quoteProducts as $data) {
                $quoteProduct = null;

                if (is_array($data)) {
                    if (isset($data['@id']) && is_string($data['@id'])) {
                        $quoteProduct = new QuoteProduct;

                        if (false !== preg_match('/\/quote_products\/(\d+)/', $data['@id'], $matches)) {
                            if (isset($matches[1])) {
                                $quoteProductId = (int)$matches[1];
                                $quoteProduct->setQuoteProductId($quoteProductId);
                            }
                        }

                        $quoteProduct
                            ->setBrandTitle($data['brand_title'])
                            ->setProductTitle($data['product_title'])
                            ->setBaseColli($data['quantity'])
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
                } else if ($data instanceof QuoteProduct) {
                    $quoteProduct = $data;
                }

                $this->addQuoteProduct($quoteProduct);
            }
        }

        return $this;
    }

    protected function productIriToEntity(string $iri): ?Product
    {
        if (false !== preg_match('/\/products\/(\d+)/', $iri, $matches)) {
            if (isset($matches[1])) {
                return (new Product)->setProductId((int)$matches[1]);
            }
        }

        return null;
    }

    /**
     * @param QuoteProduct $quoteProduct
     * @return $this
     */
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

    /**
     * @return OrderCollection
     */
    public function getOrders(): OrderCollection
    {
        return $this->orders;
    }

    /**
     * @param iterable|OrderCollection|null $orders
     * @return Quote
     */
    public function setOrders(?iterable $orders): Quote
    {
        $this->orders = new OrderCollection;

        if ($orders) {
            foreach ($orders as $data) {
                $order = null;

                if ($data instanceof Order) {
                    $order = $data;
                } else if (is_string($data)) {
                    // Convert order IRI (string) to an Order entity.
                    $order = $this->iriToOrderEntity($data);
                } else {
                    throw new LogicException('Order is neither an array nor an IRI!');
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

    protected function iriToOrderEntity(string $iri): Order
    {
        $id = (int)str_replace('/orders/', '', $iri);
        return (new Order)->setOrderId($id);
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
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

    /**
     * @inheritDoc
     */
    function toIri(): ?string
    {
        if (null === $this->getQuoteId()) {
            return null;
        }

        return '/quotes/' . $this->getQuoteId();
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->quoteProducts);
        unset($this->orders);
    }
}
