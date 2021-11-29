<?php

namespace MailCampaigns\ApiClient\Entity;

class OrderProduct implements EntityInterface
{
    /**
     * The unique numeric identifier for the order product.
     *
     * @var int
     */
    protected $orderProductId;

    /**
     * The title of the supplier.
     *
     * @var string
     */
    protected $supplierTitle;

    /**
     * The title of the brand.
     *
     * @var string
     */
    protected $brandTitle;

    /**
     * The title of the product.
     *
     * @var string
     */
    protected $productTitle;

    /**
     * @var float
     */
    protected $taxRate;

    /**
     * The number of products ordered.
     *
     * @var int
     */
    protected $quantityOrdered;

    /**
     * The number of products invoiced.
     *
     * @var int
     */
    protected $quantityInvoiced;

    /**
     * The number of products shipped.
     *
     * @var int
     */
    protected $quantityShipped;

    /**
     * The number of products refunded.
     *
     * @var int
     */
    protected $quantityRefunded;

    /**
     * The number of products returned.
     *
     * @var int
     */
    protected $quantityReturned;

    /**
     * The custom article code of the ordered product.
     *
     * @var string
     */
    protected $articleCode;

    /**
     * The EAN of the ordered product. (Example: "AB000123")
     *
     * @see https://en.wikipedia.org/wiki/International_Article_Number
     * @var string
     */
    protected $ean;

    /**
     * The SKU of the ordered product. (Example: "AB000123")
     *
     * @see https://en.wikipedia.org/wiki/Stock_keeping_unit
     * @var string
     */
    protected $sku;

    /**
     * The quantity of the ordered product.
     *
     * @var int
     */
    protected $quantity;

    /**
     * The cost price of the ordered Product.
     *
     * @var float
     */
    protected $priceCost;

    /**
     * The price per product excluding tax.
     *
     * @var float
     */
    protected $basePriceExcl;

    /**
     * The price per product including tax.
     *
     * @var float
     */
    protected $basePriceIncl;

    /**
     * The total price of the products excluding tax.
     *
     * @var float
     */
    protected $priceExcl;

    /**
     * The total price of the products including tax.
     *
     * @var float
     */
    protected $priceIncl;

    /**
     * The discount on the product excluding tax.
     *
     * @var float
     */
    protected $discountExcl;

    /**
     * The discount on the product including tax.
     *
     * @var float
     */
    protected $discountIncl;

    /**
     * Link to Product resource.
     *
     * @var Product
     */
    protected $product;

    /**
     * The order this order product belongs to.
     *
     * @var Order
     */
    protected $order;

    /**
     * @return int
     */
    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    /**
     * @param int|null $orderProductId
     * @return $this
     */
    public function setOrderProductId(?int $orderProductId): self
    {
        $this->orderProductId = $orderProductId;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return $this
     */
    public function unsetOrder(): self
    {
        $this->order = null;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierTitle(): ?string
    {
        return $this->supplierTitle;
    }

    /**
     * @param string|null $supplierTitle
     * @return $this
     */
    public function setSupplierTitle(?string $supplierTitle): self
    {
        $this->supplierTitle = $supplierTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrandTitle(): ?string
    {
        return $this->brandTitle;
    }

    /**
     * @param string|null $brandTitle
     * @return $this
     */
    public function setBrandTitle(?string $brandTitle): self
    {
        $this->brandTitle = $brandTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductTitle(): ?string
    {
        return $this->productTitle;
    }

    /**
     * @param string $productTitle
     * @return $this
     */
    public function setProductTitle(string $productTitle): self
    {
        $this->productTitle = $productTitle;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    /**
     * @param float|null $taxRate
     * @return $this
     */
    public function setTaxRate(?float $taxRate): self
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityOrdered(): ?int
    {
        return $this->quantityOrdered;
    }

    /**
     * @param int $quantityOrdered
     * @return $this
     */
    public function setQuantityOrdered(int $quantityOrdered): self
    {
        $this->quantityOrdered = $quantityOrdered;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityInvoiced(): ?int
    {
        return $this->quantityInvoiced;
    }

    /**
     * @param int|null $quantityInvoiced
     * @return $this
     */
    public function setQuantityInvoiced(?int $quantityInvoiced): self
    {
        $this->quantityInvoiced = $quantityInvoiced;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityShipped(): ?int
    {
        return $this->quantityShipped;
    }

    /**
     * @param int|null $quantityShipped
     * @return $this
     */
    public function setQuantityShipped(?int $quantityShipped): self
    {
        $this->quantityShipped = $quantityShipped;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityRefunded(): ?int
    {
        return $this->quantityRefunded;
    }

    /**
     * @param int|null $quantityRefunded
     * @return $this
     */
    public function setQuantityRefunded(?int $quantityRefunded): self
    {
        $this->quantityRefunded = $quantityRefunded;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityReturned(): ?int
    {
        return $this->quantityReturned;
    }

    /**
     * @param int|null $quantityReturned
     * @return $this
     */
    public function setQuantityReturned(?int $quantityReturned): self
    {
        $this->quantityReturned = $quantityReturned;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    /**
     * @param string|null $articleCode
     * @return $this
     */
    public function setArticleCode(?string $articleCode): self
    {
        $this->articleCode = $articleCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getEan(): ?string
    {
        return $this->ean;
    }

    /**
     * @param string|null $ean
     * @return $this
     */
    public function setEan(?string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return $this
     */
    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
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
     * @return $this
     */
    public function setQuantity(?int $quantity): self
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
     * @return $this
     */
    public function setPriceCost(?float $priceCost): self
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getBasePriceExcl(): ?float
    {
        return $this->basePriceExcl;
    }

    /**
     * @param float|null $basePriceExcl
     * @return $this
     */
    public function setBasePriceExcl(?float $basePriceExcl): self
    {
        $this->basePriceExcl = $basePriceExcl;
        return $this;
    }

    /**
     * @return float
     */
    public function getBasePriceIncl(): ?float
    {
        return $this->basePriceIncl;
    }

    /**
     * @param float|null $basePriceIncl
     * @return $this
     */
    public function setBasePriceIncl(?float $basePriceIncl): self
    {
        $this->basePriceIncl = $basePriceIncl;
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
     * @return $this
     */
    public function setPriceExcl(?float $priceExcl): self
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
     * @return $this
     */
    public function setPriceIncl(?float $priceIncl): self
    {
        $this->priceIncl = $priceIncl;
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
     * @return $this
     */
    public function setDiscountExcl(?float $discountExcl): self
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
     * @return $this
     */
    public function setDiscountIncl(?float $discountIncl): self
    {
        $this->discountIncl = $discountIncl;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return $this
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'order_product_id' => $this->getOrderProductId(),
            'product_title' => $this->getProductTitle(),
            'quantity_ordered' => $this->getQuantityOrdered(),
            'article_code' => $this->getArticleCode(),
            'product' => $this->getProduct() ? $this->getProduct()->toIri() : null,
            'supplier_title' => $this->getSupplierTitle(),
            'brand_title' => $this->getBrandTitle(),
            'tax_rate' => $this->getTaxRate(),
            'quantity_invoiced' => $this->getQuantityInvoiced(),
            'quantity_shipped' => $this->getQuantityShipped(),
            'quantity_refunded' => $this->getQuantityRefunded(),
            'quantity_returned' => $this->getQuantityReturned(),
            'ean' => $this->getEan(),
            'sku' => $this->getSku(),
            'quantity' => $this->getQuantity(),
            'price_cost' => $this->getPriceCost(),
            'base_price_excl' => $this->getBasePriceExcl(),
            'base_price_incl' => $this->getBasePriceIncl(),
            'price_excl' => $this->getPriceExcl(),
            'price_incl' => $this->getPriceIncl(),
            'discount_excl' => $this->getDiscountExcl(),
            'discount_incl' => $this->getDiscountIncl(),
            'order' => $this->getOrder() instanceof Order ? $this->getOrder()->toIri() : null
        ];
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        if (null === $this->getOrderProductId()) {
            return null;
        }

        return '/order_products/' . $this->getOrderProductId();
    }

    public function __destruct()
    {
        unset($this->order);
        unset($this->product);
    }
}
