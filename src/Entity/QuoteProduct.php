<?php

namespace MailCampaigns\ApiClient\Entity;

class QuoteProduct implements EntityInterface
{
    /**
     * The unique numeric identifier for the quote product.
     *
     * @var int
     */
    protected $quoteProductId;

    /**
     * The total colli of the quote product.
     *
     * @var int
     */
    protected $baseColli;

    /**
     * The total cost price of the quote product. (Example: 0.25)
     *
     * @var float
     */
    protected $basePriceCost;

    /**
     * The total price excluding tax. (Example: 15.1061)
     *
     * @var float
     */
    protected $basePriceExcl;

    /**
     * The total price including tax. (Example: 18.29)
     *
     * @var float
     */
    protected $basePriceIncl;

    /**
     * The quantity of the product.
     *
     * @var int
     */
    protected $quantity;

    /**
     * The discount in percentage. (Example: 0.1366867)
     *
     * @var float
     */
    protected $discountPercentage;

    /**
     * The tax rate in percentage. (Example: 0.21)
     *
     * @var float
     */
    protected $taxRate;

    /**
     * The total cost price of the quote product. (Example: 0.25)
     *
     * @var float
     */
    protected $priceCost;

    /**
     * The total cost price of the quote product. (Example: 5.5)
     *
     * @var float
     */
    protected $priceTax;

    /**
     * The total price excluding tax. (Example: 26.00)
     *
     * @var float
     */
    protected $priceExcl;

    /**
     * The total price including tax. (Example: 31.58)
     *
     * @var float
     */
    protected $priceIncl;

    /**
     * The discount price excluding tax. (Example: 4.31)
     *
     * @var float
     */
    protected $discountExcl;

    /**
     * The discount price including tax. (Example: 5)
     *
     * @var float
     */
    protected $discountIncl;

    /**
     * The additional cost price excluding tax. (Example: 0.82)
     *
     * @var float
     */
    protected $additionalCostExcl;

    /**
     * The additional cost price including tax. (Example: 1)
     *
     * @var float
     */
    protected $additionalCostIncl;

    /**
     * The additional cost base price excluding tax. (Example: 0.4132)
     *
     * @var float
     */
    protected $baseAdditionalCostExcl;

    /**
     * The additional cost base price including tax. (Example: 0.5)
     *
     * @var float
     */
    protected $baseAdditionalCostIncl;

    /**
     * Link to Product resource.
     *
     * @var Product|null
     */
    protected $product;

    /**
     * @var Quote
     */
    protected $quote;

    /**
     * @return int
     */
    public function getQuoteProductId(): ?int
    {
        return $this->quoteProductId;
    }

    /**
     * @param int $quoteProductId
     * @return QuoteProduct
     */
    public function setQuoteProductId(int $quoteProductId): QuoteProduct
    {
        $this->quoteProductId = $quoteProductId;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseColli(): ?int
    {
        return $this->baseColli;
    }

    /**
     * @param int $baseColli
     * @return QuoteProduct
     */
    public function setBaseColli(?int $baseColli): QuoteProduct
    {
        $this->baseColli = $baseColli;
        return $this;
    }

    /**
     * @return float
     */
    public function getBasePriceCost(): ?float
    {
        return $this->basePriceCost;
    }

    /**
     * @param float $basePriceCost
     * @return QuoteProduct
     */
    public function setBasePriceCost(?float $basePriceCost): QuoteProduct
    {
        $this->basePriceCost = $basePriceCost;
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
     * @param float $basePriceExcl
     * @return QuoteProduct
     */
    public function setBasePriceExcl(?float $basePriceExcl): QuoteProduct
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
     * @param float $basePriceIncl
     * @return QuoteProduct
     */
    public function setBasePriceIncl(?float $basePriceIncl): QuoteProduct
    {
        $this->basePriceIncl = $basePriceIncl;
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
     * @param int $quantity
     * @return QuoteProduct
     */
    public function setQuantity(?int $quantity): QuoteProduct
    {
        $this->quantity = $quantity;
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
     * @param float $discountPercentage
     * @return QuoteProduct
     */
    public function setDiscountPercentage(?float $discountPercentage): QuoteProduct
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     * @return QuoteProduct
     */
    public function setTaxRate(?float $taxRate): QuoteProduct
    {
        $this->taxRate = $taxRate;
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
     * @param float $priceCost
     * @return QuoteProduct
     */
    public function setPriceCost(?float $priceCost): QuoteProduct
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceTax(): ?float
    {
        return $this->priceTax;
    }

    /**
     * @param float $priceTax
     * @return QuoteProduct
     */
    public function setPriceTax(?float $priceTax): QuoteProduct
    {
        $this->priceTax = $priceTax;
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
     * @param float $priceExcl
     * @return QuoteProduct
     */
    public function setPriceExcl(?float $priceExcl): QuoteProduct
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
     * @param float $priceIncl
     * @return QuoteProduct
     */
    public function setPriceIncl(?float $priceIncl): QuoteProduct
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
     * @param float $discountExcl
     * @return QuoteProduct
     */
    public function setDiscountExcl(?float $discountExcl): QuoteProduct
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
     * @param float $discountIncl
     * @return QuoteProduct
     */
    public function setDiscountIncl(?float $discountIncl): QuoteProduct
    {
        $this->discountIncl = $discountIncl;
        return $this;
    }

    /**
     * @return float
     */
    public function getAdditionalCostExcl(): ?float
    {
        return $this->additionalCostExcl;
    }

    /**
     * @param float $additionalCostExcl
     * @return QuoteProduct
     */
    public function setAdditionalCostExcl(?float $additionalCostExcl): QuoteProduct
    {
        $this->additionalCostExcl = $additionalCostExcl;
        return $this;
    }

    /**
     * @return float
     */
    public function getAdditionalCostIncl(): ?float
    {
        return $this->additionalCostIncl;
    }

    /**
     * @param float $additionalCostIncl
     * @return QuoteProduct
     */
    public function setAdditionalCostIncl(?float $additionalCostIncl): QuoteProduct
    {
        $this->additionalCostIncl = $additionalCostIncl;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseAdditionalCostExcl(): ?float
    {
        return $this->baseAdditionalCostExcl;
    }

    /**
     * @param float $baseAdditionalCostExcl
     * @return QuoteProduct
     */
    public function setBaseAdditionalCostExcl(?float $baseAdditionalCostExcl): QuoteProduct
    {
        $this->baseAdditionalCostExcl = $baseAdditionalCostExcl;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseAdditionalCostIncl(): ?float
    {
        return $this->baseAdditionalCostIncl;
    }

    /**
     * @param float $baseAdditionalCostIncl
     * @return QuoteProduct
     */
    public function setBaseAdditionalCostIncl(?float $baseAdditionalCostIncl): QuoteProduct
    {
        $this->baseAdditionalCostIncl = $baseAdditionalCostIncl;
        return $this;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return QuoteProduct
     */
    public function setProduct(?Product $product): QuoteProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Quote
     */
    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    /**
     * @param Quote $quote
     * @return QuoteProduct
     */
    public function setQuote(?Quote $quote): QuoteProduct
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null): array
    {
        $arr = [
            'quote_product_id' => $this->getQuoteProductId(),
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
            'product' => $this->getProduct() ? $this->getProduct()->toIri() : null,
            'quote' => $this->getQuote()->toIri()
        ];

        return array_filter($arr);
    }

    /**
     * @inheritDoc
     */
    public function toIri(): string
    {
        return '/quote_products/' . $this->getQuoteProductId();
    }
}
