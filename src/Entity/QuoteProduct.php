<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\ToJsonTrait;

class QuoteProduct implements EntityInterface
{
    use ToJsonTrait;

    public function __construct(
        private ?int $quoteProductId = null,
        private ?string $brandTitle = null,
        private ?string $productTitle = null,
        private ?int $baseColli = null,
        private ?float $basePriceCost = null,
        private ?float $basePriceExcl = null,
        private ?float $basePriceIncl = null,
        private ?int $quantity = null,
        private ?float $discountPercentage = null,
        private ?float $taxRate = null,
        private ?float $priceCost = null,
        private ?float $priceTax = null,
        private ?float $priceExcl = null,
        private ?float $priceIncl = null,
        private ?float $discountExcl = null,
        private ?float $discountIncl = null,
        private ?float $additionalCostExcl = null,
        private ?float $additionalCostIncl = null,
        private ?float $baseAdditionalCostExcl = null,
        private ?float $baseAdditionalCostIncl = null,
        private ?string $lineRef = null,
        private ?Product $product = null,
        private ?Quote $quote = null,
    ) {
    }

    public function getQuoteProductId(): ?int
    {
        return $this->quoteProductId;
    }

    public function setQuoteProductId(int $quoteProductId): QuoteProduct
    {
        $this->quoteProductId = $quoteProductId;
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

    public function setProductTitle(?string $productTitle): self
    {
        $this->productTitle = $productTitle;
        return $this;
    }

    public function getBaseColli(): ?int
    {
        return $this->baseColli;
    }

    public function setBaseColli(?int $baseColli): QuoteProduct
    {
        $this->baseColli = $baseColli;
        return $this;
    }

    public function getBasePriceCost(): ?float
    {
        return $this->basePriceCost;
    }

    public function setBasePriceCost(?float $basePriceCost): QuoteProduct
    {
        $this->basePriceCost = $basePriceCost;
        return $this;
    }

    public function getBasePriceExcl(): ?float
    {
        return $this->basePriceExcl;
    }

    public function setBasePriceExcl(?float $basePriceExcl): QuoteProduct
    {
        $this->basePriceExcl = $basePriceExcl;
        return $this;
    }

    public function getBasePriceIncl(): ?float
    {
        return $this->basePriceIncl;
    }

    public function setBasePriceIncl(?float $basePriceIncl): QuoteProduct
    {
        $this->basePriceIncl = $basePriceIncl;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): QuoteProduct
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(?float $discountPercentage): QuoteProduct
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): QuoteProduct
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    public function setPriceCost(?float $priceCost): QuoteProduct
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    public function getPriceTax(): ?float
    {
        return $this->priceTax;
    }

    public function setPriceTax(?float $priceTax): QuoteProduct
    {
        $this->priceTax = $priceTax;
        return $this;
    }

    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    public function setPriceExcl(?float $priceExcl): QuoteProduct
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    public function setPriceIncl(?float $priceIncl): QuoteProduct
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    public function getDiscountExcl(): ?float
    {
        return $this->discountExcl;
    }

    public function setDiscountExcl(?float $discountExcl): QuoteProduct
    {
        $this->discountExcl = $discountExcl;
        return $this;
    }

    public function getDiscountIncl(): ?float
    {
        return $this->discountIncl;
    }

    public function setDiscountIncl(?float $discountIncl): QuoteProduct
    {
        $this->discountIncl = $discountIncl;
        return $this;
    }

    public function getAdditionalCostExcl(): ?float
    {
        return $this->additionalCostExcl;
    }

    public function setAdditionalCostExcl(?float $additionalCostExcl): QuoteProduct
    {
        $this->additionalCostExcl = $additionalCostExcl;
        return $this;
    }


    public function getAdditionalCostIncl(): ?float
    {
        return $this->additionalCostIncl;
    }

    public function setAdditionalCostIncl(?float $additionalCostIncl): QuoteProduct
    {
        $this->additionalCostIncl = $additionalCostIncl;
        return $this;
    }

    public function getBaseAdditionalCostExcl(): ?float
    {
        return $this->baseAdditionalCostExcl;
    }

    public function setBaseAdditionalCostExcl(?float $baseAdditionalCostExcl): QuoteProduct
    {
        $this->baseAdditionalCostExcl = $baseAdditionalCostExcl;
        return $this;
    }

    public function getBaseAdditionalCostIncl(): ?float
    {
        return $this->baseAdditionalCostIncl;
    }

    public function setBaseAdditionalCostIncl(?float $baseAdditionalCostIncl): QuoteProduct
    {
        $this->baseAdditionalCostIncl = $baseAdditionalCostIncl;
        return $this;
    }

    public function getLineRef(): ?string
    {
        return $this->lineRef;
    }

    public function setLineRef(?string $lineRef): QuoteProduct
    {
        $this->lineRef = $lineRef;
        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): QuoteProduct
    {
        $this->product = $product;
        return $this;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): QuoteProduct
    {
        $this->quote = $quote;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'quote_product_id' => $this->getQuoteProductId(),
            'brand_title' => $this->getBrandTitle(),
            'product_title' => $this->getProductTitle(),
            'base_colli' => $this->getBaseColli(),
            'base_price_cost' => $this->getBasePriceCost(),
            'base_price_excl' => $this->getBasePriceExcl(),
            'base_price_incl' => $this->getBasePriceIncl(),
            'quantity' => $this->getQuantity(),
            'discount_percentage' => $this->getDiscountPercentage(),
            'tax_rate' => $this->getTaxRate(),
            'price_cost' => $this->getPriceCost(),
            'price_tax' => $this->getPriceTax(),
            'price_excl' => $this->getPriceExcl(),
            'price_incl' => $this->getPriceIncl(),
            'discount_excl' => $this->getDiscountExcl(),
            'discount_incl' => $this->getDiscountIncl(),
            'additional_cost_excl' => $this->getAdditionalCostExcl(),
            'additional_cost_incl' => $this->getAdditionalCostIncl(),
            'base_additional_cost_excl' => $this->getBaseAdditionalCostExcl(),
            'base_additional_cost_incl' => $this->getBaseAdditionalCostIncl(),
            'line_ref' => $this->getLineRef(),
            'product' => $this->getProduct()?->toIri(),
            'quote' => $this->getQuote()?->toIri()
        ];
    }

    public function toIri(): ?string
    {
        if (null === $this->getQuoteProductId()) {
            return null;
        }

        return '/quote_products/' . $this->getQuoteProductId();
    }

    public function __destruct()
    {
        unset($this->product);
        unset($this->quote);
    }
}
