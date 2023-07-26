<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class OrderProduct implements EntityInterface
{
    public function __construct(
        private ?int $orderProductId = null,
        private ?string $supplierTitle = null,
        private ?string $brandTitle = null,
        private ?string $productTitle = null,
        private ?float $taxRate = null,
        private ?int $quantityOrdered = null,
        private ?int $quantityInvoiced = null,
        private ?int $quantityShipped = null,
        private ?int $quantityRefunded = null,
        private ?int $quantityReturned = null,
        private ?string $articleCode = null,
        private ?string $ean = null,
        private ?string $sku = null,
        private ?int $quantity = null,
        private ?float $priceCost = null,
        private ?float $basePriceExcl = null,
        private ?float $basePriceIncl = null,
        private ?float $priceExcl = null,
        private ?float $priceIncl = null,
        private ?float $discountExcl = null,
        private ?float $discountIncl = null,
        private ?Product $product = null,
        private ?Order $order = null,
    ) {
    }

    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    public function setOrderProductId(?int $orderProductId): self
    {
        $this->orderProductId = $orderProductId;
        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function unsetOrder(): self
    {
        $this->order = null;
        return $this;
    }

    public function getSupplierTitle(): ?string
    {
        return $this->supplierTitle;
    }

    public function setSupplierTitle(?string $supplierTitle): self
    {
        $this->supplierTitle = $supplierTitle;
        return $this;
    }

    public function getBrandTitle(): ?string
    {
        return $this->brandTitle;
    }

    public function setBrandTitle(?string $brandTitle): self
    {
        $this->brandTitle = $brandTitle;
        return $this;
    }

    public function getProductTitle(): ?string
    {
        return $this->productTitle;
    }

    public function setProductTitle(string $productTitle): self
    {
        $this->productTitle = $productTitle;
        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): self
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    public function getQuantityOrdered(): ?int
    {
        return $this->quantityOrdered;
    }

    public function setQuantityOrdered(int $quantityOrdered): self
    {
        $this->quantityOrdered = $quantityOrdered;
        return $this;
    }

    public function getQuantityInvoiced(): ?int
    {
        return $this->quantityInvoiced;
    }

    public function setQuantityInvoiced(?int $quantityInvoiced): self
    {
        $this->quantityInvoiced = $quantityInvoiced;
        return $this;
    }

    public function getQuantityShipped(): ?int
    {
        return $this->quantityShipped;
    }

    public function setQuantityShipped(?int $quantityShipped): self
    {
        $this->quantityShipped = $quantityShipped;
        return $this;
    }

    public function getQuantityRefunded(): ?int
    {
        return $this->quantityRefunded;
    }

    public function setQuantityRefunded(?int $quantityRefunded): self
    {
        $this->quantityRefunded = $quantityRefunded;
        return $this;
    }

    public function getQuantityReturned(): ?int
    {
        return $this->quantityReturned;
    }

    public function setQuantityReturned(?int $quantityReturned): self
    {
        $this->quantityReturned = $quantityReturned;
        return $this;
    }


    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    public function setArticleCode(?string $articleCode): self
    {
        $this->articleCode = $articleCode;
        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
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

    public function getBasePriceExcl(): ?float
    {
        return $this->basePriceExcl;
    }

    public function setBasePriceExcl(?float $basePriceExcl): self
    {
        $this->basePriceExcl = $basePriceExcl;
        return $this;
    }

    public function getBasePriceIncl(): ?float
    {
        return $this->basePriceIncl;
    }

    public function setBasePriceIncl(?float $basePriceIncl): self
    {
        $this->basePriceIncl = $basePriceIncl;
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'order_product_id' => $this->getOrderProductId(),
            'product_title' => $this->getProductTitle(),
            'quantity_ordered' => $this->getQuantityOrdered(),
            'article_code' => $this->getArticleCode(),
            'product' => $this->getProduct()?->toIri(),
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
            'order' => $this->getOrder() instanceof Order
                ? $this->getOrder()->toIri() : null
        ];
    }

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
