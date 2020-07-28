<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use InvalidArgumentException;
use LogicException;
use MailCampaigns\ApiClient\Collection\ProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductCategoryProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;

class Product implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

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

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->isVisible = true;
        $this->reviews = new ProductReviewCollection;
        $this->categories = new ProductCategoryProductCollection;
        $this->relatedProducts = new ProductRelatedProductCollection;
        $this->crossSellProducts = new ProductCrossSellProductCollection;
        $this->upSellProducts = new ProductUpSellProductCollection;
        $this->volumeSellProducts = new ProductVolumeSellProductCollection;
    }

    /**
     * @inheritDoc
     */
    function toArray(): array
    {
        // TODO: Finish toArray() method.
        return [
            'product_id' => $this->getProductId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'is_visible' => $this->getIsVisible(),
            'visibility' => $this->getVisibility(),
            'url' => $this->getUrl(),
            'title' => $this->getTitle(),
            'full_title' => $this->getFullTitle(),
            'brand' => $this->getBrand(),
            'description' => $this->getDescription(),
            'content' => $this->getContent(),
            'image' => $this->getImage(),
            'article_code' => $this->getArticleCode(),
            'ean' => $this->getEan(),
            'sku' => $this->getSku(),
            'price_cost' => $this->getPriceCost(),
            'price_excl' => $this->getPriceExcl(),
            'price_incl' => $this->getPriceIncl(),
            'old_price_excl' => $this->getOldPriceExcl(),
            'old_price_incl' => $this->getOldPriceIncl(),
            'stock_status' => $this->getStockStatus(),
            'stock_count' => $this->getStockCount(),
            'tax' => $this->getTax(),
            'tax_rate' => $this->getTaxRate(),
            'categories' => $this->getCategories()->toIri(),
            'related_products' => $this->getRelatedProducts()->toIri(),
            'cross_sell_products' => $this->getCrossSellProducts()->toIri(),
            'up_sell_products' => $this->getUpSellProducts()->toIri(),
            'volume_sell_products' => $this->getVolumeSellProducts()->toIri(),
            'reviews' => $this->getReviews()->toIri()
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        // todo: checken
//        if (null === $this->getProductId()) {
//            return '';
//        }

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
    public function setProductId(int $productId): self
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
    public function setTitle(string $title): self
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
    public function setUrl(?string $url): self
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
    public function setFullTitle(?string $fullTitle): self
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
    public function setBrand(?string $brand): self
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
    public function setDescription(?string $description): self
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
    public function setContent(?string $content): self
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
    public function setImage(?string $image): self
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
    public function setArticleCode(?string $articleCode): self
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
    public function setEan(?string $ean): self
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
    public function setSku(?string $sku): self
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
    public function setPriceCost(?float $priceCost): self
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
    public function setPriceExcl(?float $priceExcl): self
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
    public function setPriceIncl(?float $priceIncl): self
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
    public function setOldPriceExcl(?float $oldPriceExcl): self
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
    public function setOldPriceIncl(?float $oldPriceIncl): self
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
    public function setStockStatus(?string $stockStatus): self
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
    public function setStockCount(?int $stockCount): self
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
    public function setTax(?float $tax): self
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
    public function setTaxRate(?float $taxRate): self
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return ProductCategoryProductCollection
     */
    public function getCategories(): ProductCategoryProductCollection
    {
        return $this->categories;
    }

    public function setCategories(ProductCategoryProductCollection $collection): self
    {
        $this->categories = new ProductCategoryProductCollection;

        foreach ($collection as $pcp) {
            // todo: zelfde manier als crossSell
//            if (!$pcp instanceof ProductCategoryProduct) {
//                $productCategory = (new ProductCategory)
//                    ->setProductCategoryId($this->IdFromIri('/product_categories/', $pcp['product_category']['@id']));
//
//                $pcp = (new ProductCategoryProduct)
//                    ->setProduct($this)
//                    ->setProductCategory($productCategory);
//            }

            $this->addCategory($pcp);
        }

        return $this;
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
//
//    /**
//     * @return ProductReviewCollection
//     */
//    public function getReviews(): ProductReviewCollection
//    {
//        return $this->reviews;
//    }
//
//    /**
//     * @param ProductReviewCollection $reviews
//     * @return Product
//     */
//    public function setReviews(ProductReviewCollection $reviews): self
//    {
//        $this->reviews = new ProductReviewCollection;
//
//        foreach ($reviews as $review) {
//            $this->addReview($review);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @param ProductReview $review
//     * @return Product
//     */
//    public function addReview(ProductReview $review): self
//    {
//        if (!$this->reviews->contains($review)) {
//            if ($review->getProduct() !== $this) {
//                $review->setProduct($this);
//            }
//
//            $this->reviews->add($review);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @param ProductReview $review
//     * @return Product
//     */
//    public function removeReview(ProductReview $review): self
//    {
//        if ($this->reviews->contains($review)) {
//            $this->reviews->removeElement($review);
//        }
//
//        return $this;
//    }

    public function getRelatedProducts(): ProductRelatedProductCollection
    {
        return $this->relatedProducts;
    }

    public function setRelatedProducts(ProductRelatedProductCollection $collection): self
    {
        $this->relatedProducts = new ProductRelatedProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is supplied.
            $entity = !$element instanceof ProductRelatedProduct
                ? $this->toProductRelatedProductEntity($element) : $element;

            $this->addRelatedProduct($entity);
        }

        return $this;
    }

    public function addRelatedProduct(ProductRelatedProduct $relatedProduct): self
    {
        if (!$this->relatedProducts->contains($relatedProduct)) {
            if ($relatedProduct->getProduct() !== $this) {
                $relatedProduct->setProduct($this);
            }

            $this->relatedProducts->add($relatedProduct);
        }

        return $this;
    }

    public function removeRelatedProduct(ProductRelatedProduct $relatedProduct): self
    {
        if ($this->relatedProducts->contains($relatedProduct)) {
            $this->relatedProducts->removeElement($relatedProduct);
        }

        return $this;
    }

    public function getCrossSellProducts(): ProductCrossSellProductCollection
    {
        return $this->crossSellProducts;
    }

    public function setCrossSellProducts(ProductCrossSellProductCollection $collection): self
    {
        $this->crossSellProducts = new ProductCrossSellProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is supplied.
            $entity = !$element instanceof ProductCrossSellProduct
                ? $this->toProductCrossSellProductEntity($element) : $element;

            $this->addCrossSellProduct($entity);
        }

        return $this;
    }

    public function addCrossSellProduct(ProductCrossSellProduct $crossSellProduct): self
    {
        if (!$this->crossSellProducts->contains($crossSellProduct)) {
            if ($crossSellProduct->getProduct() !== $this) {
                $crossSellProduct->setProduct($this);
            }

            $this->crossSellProducts->add($crossSellProduct);
        }

        return $this;
    }

    public function removeCrossSellProduct(ProductCrossSellProduct $crossSellProduct): self
    {
        if ($this->crossSellProducts->contains($crossSellProduct)) {
            $this->crossSellProducts->removeElement($crossSellProduct);
        }

        return $this;
    }

//    /**
//     * @return ProductUpSellProductCollection
//     */
//    public function getUpSellProducts(): ProductUpSellProductCollection
//    {
//        return $this->upSellProducts;
//    }
//
//    /**
//     * @param ProductUpSellProductCollection $upSellProducts
//     * @return Product
//     */
//    public function setUpSellProducts(ProductUpSellProductCollection $upSellProducts): self
//    {
//        $this->upSellProducts = new ProductUpSellProductCollection;
//
//        foreach ($upSellProducts as $upSellProduct) {
//            $this->addUpSellProduct($upSellProduct);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @param ProductUpSellProduct $upSellProduct
//     * @return Product
//     */
//    public function addUpSellProduct(ProductUpSellProduct $upSellProduct): self
//    {
//        if (!$this->upSellProducts->contains($upSellProduct)) {
//            if ($upSellProduct->getProduct() !== $this) {
//                $upSellProduct->setProduct($this);
//            }
//
//            $this->upSellProducts->add($upSellProduct);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @param ProductUpSellProduct $upSellProduct
//     * @return Product
//     */
//    public function removeUpSellProduct(ProductUpSellProduct $upSellProduct): self
//    {
//        if ($this->upSellProducts->contains($upSellProduct)) {
//            $this->upSellProducts->removeElement($upSellProduct);
//        }
//
//        return $this;
//    }

//    /**
//     * @return ProductVolumeSellProductCollection
//     */
//    public function getVolumeSellProducts(): ProductVolumeSellProductCollection
//    {
//        return $this->volumeSellProducts;
//    }
//
//    /**
//     * @param ProductVolumeSellProductCollection $volumeSellProducts
//     * @return Product
//     */
//    public function setVolumeSellProducts(ProductVolumeSellProductCollection $volumeSellProducts): self
//    {
////        $this->volumeSellProducts = new ProductVolumeSellProductCollection;
//
////        foreach ($volumeSellProducts as $volumeSellProduct) {
////            $this->addVolumeSellProduct($volumeSellProduct);
////        }
//        $this->volumeSellProducts = $volumeSellProducts;
//        return $this;
//    }
//
//    /**
//     * @param ProductVolumeSellProduct $volumeSellProduct
//     * @return Product
//     */
//    public function addVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): self
//    {
//        if (!$this->volumeSellProducts->contains($volumeSellProduct)) {
//            if ($volumeSellProduct->getProduct() !== $this) {
//                $volumeSellProduct->setProduct($this);
//            }
//
//            $this->volumeSellProducts->add($volumeSellProduct);
//        }
//
//        return $this;
//    }
//
//    /**
//     * @param ProductVolumeSellProduct $volumeSellProduct
//     * @return Product
//     */
//    public function removeVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): self
//    {
//        if ($this->volumeSellProducts->contains($volumeSellProduct)) {
//            $this->volumeSellProducts->removeElement($volumeSellProduct);
//        }
//
//        return $this;
//    }

//    protected function idFromIri($path, ?string $iri): ?int
//    {
//        $pattern = '/' . str_replace('/', '\\/', $path) . '(\d+)/';
//
//        if (false !== preg_match($pattern, $iri, $matches)) {
//            if (isset($matches[1])) {
//                return (int)$matches[1];
//            }
//        }
//
//        return null;
//    }

    protected function toProductRelatedProductEntity(array $data): ProductRelatedProduct
    {
        $id = null;
        $title = $data['title'];
        $pattern = '/.*\/[a-zA-Z]+=(?\'product_id\'[\d]+);[a-zA-Z]+=(?\'cross_sell_product_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['cross_sell_product_id'])) {
                $id = (int)$matches['cross_sell_product_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine cross sell product id!');
        }

        $relatedProduct = (new Product)->setProductId($id)->setTitle($title);

        return (new ProductRelatedProduct)
            ->setProduct($this)
            ->setRelatedProduct($relatedProduct);
    }

    protected function toProductCrossSellProductEntity(array $data): ProductCrossSellProduct
    {
        $id = null;
        $title = $data['title'];
        $pattern = '/.*\/[a-zA-Z]+=(?\'product_id\'[\d]+);[a-zA-Z]+=(?\'cross_sell_product_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['cross_sell_product_id'])) {
                $id = (int)$matches['cross_sell_product_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine cross sell product id!');
        }

        $crossSellProduct = (new Product)->setProductId($id)->setTitle($title);

        return (new ProductCrossSellProduct)
            ->setProduct($this)
            ->setCrossSellProduct($crossSellProduct);
    }
}
