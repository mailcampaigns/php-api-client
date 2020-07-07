<?php

namespace MailCampaigns\ApiClient\Entity;

use App\Entity\ProductCategoryProduct;
use DateTime;
use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\ProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;

class Product implements EntityInterface
{
    use DateTrait;

    /**
     * @var string
     */
    protected $iri;

    /**
     * The unique numeric identifier for the product.
     *
     * @var int
     */
    protected $productId;

    /**
     * Creation date and time.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Date and time of last update.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Product visibility.
     *
     * @var bool|null
     */
    protected $isVisible;

    /**
     * Product visibility setting. <i>(Examples: "hidden", "visible", "auto")</i>
     *
     * @var string|null
     */
    protected $visibility;

    /**
     * Product slug. <i>(Example: "lookin-sharp-tee")</i>
     *
     * @var string|null
     */
    protected $url;

    /**
     * Product title. <i>(Example: "Lookin’ Sharp T-Shirt")</i>
     *
     * @var string
     */
    protected $title;

    /**
     * Product full title. <i>(Example: "Lookin’ Sharp T-Shirt")</i>
     *
     * @var string|null
     */
    protected $fullTitle;

    /**
     * Product brand. <i>(Example: "Sharp")</i>
     *
     * @var string|null
     */
    protected $brand;

    /**
     * Product description. <i>(Example: "Description of the Lookin’ Sharp T-Shirt")</i>
     *
     * @var string|null
     */
    protected $description;

    /**
     * Product content. <i>(Example: "&lt;p&gt;Long Description of the Lookin’ Sharp T-Shirt&lt;/p&gt;")</i>
     *
     * @var string|null
     */
    protected $content;

    /**
     * Main product image URI/URL. <i>(Example: "https://your-tee-shop.com/image/lookin-sharp-tee.png")</i>
     *
     * @var string|null
     */
    protected $image;

    /**
     * The custom article code of the product. <i>(For example the unqiue reference in your database: "TSHOP123262")</i>
     *
     * @var string|null
     */
    protected $articleCode;

    /**
     * The EAN of the product. <i>(Example: "AB000123")</i>
     *
     * @see https://en.wikipedia.org/wiki/International_Article_Number
     * @var string|null
     */
    protected $ean;

    /**
     * The SKU of the product. <i>(Example: "AB000123")</i>
     *
     * @see https://en.wikipedia.org/wiki/Stock_keeping_unit
     * @var string|null
     */
    protected $sku;

    /**
     * The cost price of the product.
     *
     * @var float|null
     */
    protected $priceCost;

    /**
     * The price per product excluding tax.
     *
     * @var float|null
     */
    protected $priceExcl;

    /**
     * The price per product including tax.
     *
     * @var float|null
     */
    protected $priceIncl;

    /**
     * The old price per product excluding tax. <i>(Example: 5.50)</i>
     *
     * @var float|null
     */
    protected $oldPriceExcl;

    /**
     * The old price per product including tax. <i>(Example: 6.25)</i>
     *
     * @var float|null
     */
    protected $oldPriceIncl;

    /**
     * The stock status of the product. <i>(Examples: ”on_stock”, “temp_out_of_stock”, “out_of_stock”)</i>
     *
     * @var string|null
     */
    protected $stockStatus;

    /**
     * The amount of products in stock.
     *
     * @var int
     */
    protected $stockCount;

    /**
     * The amount of tax that applies to this product. <i>(Example: 2.53)</i>
     *
     * @var float
     */
    protected $tax;

    /**
     * Tax rate that applies to this product. <i>(Example: 0.21 which equals to 21%)</i>
     *
     * @var float|null
     */
    protected $taxRate;

    /**
     * The categories of the product.
     *
     * @var ProductCategoryCollection
     */
    protected $categories;

    /**
     * Products related to this product.
     *
     * @var ProductRelatedProductCollection
     */
    protected $relatedProducts;

    /**
     * Cross-sell products.
     *
     * @var ProductCrossSellProductCollection
     */
    protected $crossSellProducts;

    /**
     * Up-sell products.
     *
     * @var ProductUpSellProductCollection
     */
    protected $upSellProducts;

    /**
     * Volume-sell products.
     *
     * @var ProductVolumeSellProductCollection
     */
    protected $volumeSellProducts;

    /**
     * Product's reviews.
     *
     * @var ProductReviewCollection
     */
    protected $reviews;

    /**
     * @inheritDoc
     */
    function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        // todo: check
        return $this->iri ?? '/products/' . $this->getProductId();
    }

    /**
     * @param string $iri
     * @return $this
     */
    function setIri(string $iri): self
    {
        if (false !== preg_match('/\/products\/(\d+)/', $iri, $matches)) {
            $this->iri = $iri;

            if (isset($matches[1])) {
                $this->setProductId((int)$matches[1]);
            }
        } else {
            throw new InvalidArgumentException('Invalid IRI!');
        }

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->isVisible = true;
        $this->reviews = new ProductReviewCollection;
        $this->categories = new ProductCategoryCollection;
        $this->relatedProducts = new ProductRelatedProductCollection;
        $this->crossSellProducts = new ProductCrossSellProductCollection;
        $this->upSellProducts = new ProductUpSellProductCollection;
        $this->volumeSellProducts = new ProductVolumeSellProductCollection;
    }

    /**
     * @return int
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return Product
     */
    public function setProductId(int $productId): Product
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsVisible(): bool
    {
        return true === $this->isVisible;
    }

    /**
     * @param bool $isVisible
     * @return Product
     */
    public function setIsVisible(?bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * @return string
     */
    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     * @return Product
     */
    public function setVisibility(?string $visibility): self
    {
        $this->visibility = $visibility;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Product
     */
    public function setUrl(?string $url): Product
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullTitle(): ?string
    {
        return $this->fullTitle;
    }

    /**
     * @param string|null $fullTitle
     * @return Product
     */
    public function setFullTitle(?string $fullTitle): Product
    {
        $this->fullTitle = $fullTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     * @return Product
     */
    public function setBrand(?string $brand): Product
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Product
     */
    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Product
     */
    public function setContent(?string $content): Product
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Product
     */
    public function setImage(?string $image): Product
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    /**
     * @param string|null $articleCode
     * @return Product
     */
    public function setArticleCode(?string $articleCode): Product
    {
        $this->articleCode = $articleCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEan(): ?string
    {
        return $this->ean;
    }

    /**
     * @param string|null $ean
     * @return Product
     */
    public function setEan(?string $ean): Product
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return Product
     */
    public function setSku(?string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    /**
     * @param float|null $priceCost
     * @return Product
     */
    public function setPriceCost(?float $priceCost): Product
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    /**
     * @param float|null $priceExcl
     * @return Product
     */
    public function setPriceExcl(?float $priceExcl): Product
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    /**
     * @param float|null $priceIncl
     * @return Product
     */
    public function setPriceIncl(?float $priceIncl): Product
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getOldPriceExcl(): ?float
    {
        return $this->oldPriceExcl;
    }

    /**
     * @param float|null $oldPriceExcl
     * @return Product
     */
    public function setOldPriceExcl(?float $oldPriceExcl): Product
    {
        $this->oldPriceExcl = $oldPriceExcl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getOldPriceIncl(): ?float
    {
        return $this->oldPriceIncl;
    }

    /**
     * @param float|null $oldPriceIncl
     * @return Product
     */
    public function setOldPriceIncl(?float $oldPriceIncl): Product
    {
        $this->oldPriceIncl = $oldPriceIncl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStockStatus(): ?string
    {
        return $this->stockStatus;
    }

    /**
     * @param string|null $stockStatus
     * @return Product
     */
    public function setStockStatus(?string $stockStatus): Product
    {
        $this->stockStatus = $stockStatus;
        return $this;
    }

    /**
     * @return int
     */
    public function getStockCount(): ?int
    {
        return $this->stockCount;
    }

    /**
     * @param int $stockCount
     * @return Product
     */
    public function setStockCount(?int $stockCount): Product
    {
        $this->stockCount = $stockCount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTax(): ?float
    {
        return $this->tax;
    }

    /**
     * @param float|null $tax
     * @return Product
     */
    public function setTax(?float $tax): Product
    {
        $this->tax = $tax;
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
     * @return Product
     */
    public function setTaxRate(?float $taxRate): Product
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories->getValues();
    }

    /**
     * @param ProductCategoryProduct $productCategoryProduct
     * @return $this
     */
    public function addCategory(ProductCategoryProduct $productCategoryProduct): self
    {
        if (!$this->categories->contains($productCategoryProduct)) {
            if ($productCategoryProduct->getProduct() !== $this) {
                $productCategoryProduct->setProduct($this);
            }

            $this->categories->add($productCategoryProduct);
        }

        return $this;
    }

    /**
     * @param ProductCategoryProduct $productCategoryProduct
     * @return $this
     */
    public function removeCategory(ProductCategoryProduct $productCategoryProduct): self
    {
        if ($this->categories->contains($productCategoryProduct)) {
            $this->categories->removeElement($productCategoryProduct);
        }

        return $this;
    }

    /**
     * @return ProductReviewCollection
     */
    public function getReviews(): ProductReviewCollection
    {
        return $this->reviews;
    }

    /**
     * @param ProductReviewCollection $reviews
     * @return Product
     */
    public function setReviews(ProductReviewCollection $reviews): Product
    {
        $this->reviews = new ProductReviewCollection;

        foreach ($reviews as $review) {
            $this->addReview($review);
        }

        return $this;
    }

    /**
     * @param ProductReview $review
     * @return Product
     */
    public function addReview(ProductReview $review): Product
    {
        if (!$this->reviews->contains($review)) {
            if ($review->getProduct() !== $this) {
                $review->setProduct($this);
            }

            $this->reviews->add($review);
        }

        return $this;
    }

    /**
     * @param ProductReview $review
     * @return Product
     */
    public function removeReview(ProductReview $review): Product
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
        }

        return $this;
    }

    /**
     * @return ProductRelatedProductCollection
     */
    public function getRelatedProducts(): ProductRelatedProductCollection
    {
        return $this->relatedProducts;
    }

    /**
     * @param ProductRelatedProductCollection $relatedProducts
     * @return Product
     */
    public function setRelatedProducts(ProductRelatedProductCollection $relatedProducts): Product
    {
        $this->relatedProducts = new ProductRelatedProductCollection;

        foreach ($relatedProducts as $relatedProduct) {
            $this->addRelatedProduct($relatedProduct);
        }

        return $this;
    }

    /**
     * @param ProductRelatedProduct $relatedProduct
     * @return Product
     */
    public function addRelatedProduct(ProductRelatedProduct $relatedProduct): Product
    {
        if (!$this->relatedProducts->contains($relatedProduct)) {
            if ($relatedProduct->getProduct() !== $this) {
                $relatedProduct->setProduct($this);
            }

            $this->relatedProducts->add($relatedProduct);
        }

        return $this;
    }

    /**
     * @param ProductRelatedProduct $relatedProduct
     * @return Product
     */
    public function removeRelatedProduct(ProductRelatedProduct $relatedProduct): Product
    {
        if ($this->relatedProducts->contains($relatedProduct)) {
            $this->relatedProducts->removeElement($relatedProduct);
        }

        return $this;
    }

    /**
     * @return ProductCrossSellProductCollection
     */
    public function getCrossSellProducts(): ProductCrossSellProductCollection
    {
        return $this->crossSellProducts;
    }

    /**
     * @param ProductCrossSellProductCollection $crossSellProducts
     * @return Product
     */
    public function setCrossSellProducts(ProductCrossSellProductCollection $crossSellProducts): Product
    {
        $this->crossSellProducts = new ProductCrossSellProductCollection;

        foreach ($crossSellProducts as $crossSellProduct) {
            $this->addCrossSellProduct($crossSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductCrossSellProduct $crossSellProduct
     * @return Product
     */
    public function addCrossSellProduct(ProductCrossSellProduct $crossSellProduct): Product
    {
        if (!$this->crossSellProducts->contains($crossSellProduct)) {
            if ($crossSellProduct->getProduct() !== $this) {
                $crossSellProduct->setProduct($this);
            }

            $this->crossSellProducts->add($crossSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductCrossSellProduct $crossSellProduct
     * @return Product
     */
    public function removeCrossSellProduct(ProductCrossSellProduct $crossSellProduct): Product
    {
        if ($this->crossSellProducts->contains($crossSellProduct)) {
            $this->crossSellProducts->removeElement($crossSellProduct);
        }

        return $this;
    }

    /**
     * @return ProductUpSellProductCollection
     */
    public function getUpSellProducts(): ProductUpSellProductCollection
    {
        return $this->upSellProducts;
    }

    /**
     * @param ProductUpSellProductCollection $upSellProducts
     * @return Product
     */
    public function setUpSellProducts(ProductUpSellProductCollection $upSellProducts): Product
    {
        $this->upSellProducts = new ProductUpSellProductCollection;

        foreach ($upSellProducts as $upSellProduct) {
            $this->addUpSellProduct($upSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductUpSellProduct $upSellProduct
     * @return Product
     */
    public function addUpSellProduct(ProductUpSellProduct $upSellProduct): Product
    {
        if (!$this->upSellProducts->contains($upSellProduct)) {
            if ($upSellProduct->getProduct() !== $this) {
                $upSellProduct->setProduct($this);
            }

            $this->upSellProducts->add($upSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductUpSellProduct $upSellProduct
     * @return Product
     */
    public function removeUpSellProduct(ProductUpSellProduct $upSellProduct): Product
    {
        if ($this->upSellProducts->contains($upSellProduct)) {
            $this->upSellProducts->removeElement($upSellProduct);
        }

        return $this;
    }

    /**
     * @return ProductVolumeSellProductCollection
     */
    public function getVolumeSellProducts(): ProductVolumeSellProductCollection
    {
        return $this->volumeSellProducts;
    }

    /**
     * @param ProductVolumeSellProductCollection $volumeSellProducts
     * @return Product
     */
    public function setVolumeSellProducts(ProductVolumeSellProductCollection $volumeSellProducts): Product
    {
        $this->volumeSellProducts = new ProductVolumeSellProductCollection;

        foreach ($volumeSellProducts as $volumeSellProduct) {
            $this->addVolumeSellProduct($volumeSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductVolumeSellProduct $volumeSellProduct
     * @return Product
     */
    public function addVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): Product
    {
        if (!$this->volumeSellProducts->contains($volumeSellProduct)) {
            if ($volumeSellProduct->getProduct() !== $this) {
                $volumeSellProduct->setProduct($this);
            }

            $this->volumeSellProducts->add($volumeSellProduct);
        }

        return $this;
    }

    /**
     * @param ProductVolumeSellProduct $volumeSellProduct
     * @return Product
     */
    public function removeVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): Product
    {
        if ($this->volumeSellProducts->contains($volumeSellProduct)) {
            $this->volumeSellProducts->removeElement($volumeSellProduct);
        }

        return $this;
    }
}
