<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
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
    function toArray(?string $operation = self::OPERATION_GET): array
    {
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
            'categories' => $this->getCategories()->toArray($operation),
            'related_products' => $this->getRelatedProducts()->toArray($operation),
            'cross_sell_products' => $this->getCrossSellProducts()->toArray($operation),
            'up_sell_products' => $this->getUpSellProducts()->toArray($operation),
            'volume_sell_products' => $this->getVolumeSellProducts()->toArray($operation),
            'reviews' => $this->getReviews()->toArray($operation)
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        return '/products/' . $this->getProductId();
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

        public function getCategories(): ProductCategoryProductCollection
    {
        return $this->categories;
    }

    public function setCategories(ProductCategoryProductCollection $collection): self
    {
        $this->categories = new ProductCategoryProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is supplied.
            $entity = !$element instanceof ProductCategoryProduct
                ? $this->toProductCategoryProductEntity($element) : $element;

            $this->addCategory($entity);
        }

        return $this;
    }

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

    public function removeCategory(ProductCategoryProduct $productCategoryProduct): self
    {
        if ($this->categories->contains($productCategoryProduct)) {
            $this->categories->removeElement($productCategoryProduct);
        }

        return $this;
    }

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

    public function getReviews(): ProductReviewCollection
    {
        return $this->reviews;
    }
    
    public function setReviews(ProductReviewCollection $collection): self
    {
        $this->reviews = new ProductReviewCollection;
        
        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is supplied.
            $entity = !$element instanceof ProductReview
                ? $this->toProductReviewEntity($element) : $element;

            $this->addReview($entity);
        }
        
        return $this;
    }

    public function addReview(ProductReview $review): self
    {
        if (!$this->reviews->contains($review)) {
            if ($review->getProduct() !== $this) {
                $review->setProduct($this);
            }

            $this->reviews->add($review);
        }

        return $this;
    }
    
    public function removeReview(ProductReview $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
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

    public function getUpSellProducts(): ProductUpSellProductCollection
    {
        return $this->upSellProducts;
    }

    public function setUpSellProducts(ProductUpSellProductCollection $collection): self
    {
        $this->upSellProducts = new ProductUpSellProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is supplied.
            $entity = !$element instanceof ProductUpSellProduct
                ? $this->toProductUpSellProductEntity($element) : $element;

            $this->addUpSellProduct($entity);
        }

        return $this;
    }

    public function addUpSellProduct(ProductUpSellProduct $upSellProduct): self
    {
        if (!$this->upSellProducts->contains($upSellProduct)) {
            if ($upSellProduct->getProduct() !== $this) {
                $upSellProduct->setProduct($this);
            }

            $this->upSellProducts->add($upSellProduct);
        }

        return $this;
    }

    public function removeUpSellProduct(ProductUpSellProduct $upSellProduct): self
    {
        if ($this->upSellProducts->contains($upSellProduct)) {
            $this->upSellProducts->removeElement($upSellProduct);
        }

        return $this;
    }

    public function getVolumeSellProducts(): ProductVolumeSellProductCollection
    {
        return $this->volumeSellProducts;
    }

    public function setVolumeSellProducts(ProductVolumeSellProductCollection $collection): self
    {
        $this->volumeSellProducts = new ProductVolumeSellProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) for the item is svolumeplied.
            $entity = !$element instanceof ProductVolumeSellProduct
                ? $this->toProductVolumeSellProductEntity($element) : $element;

            $this->addVolumeSellProduct($entity);
        }

        return $this;
    }

    public function addVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): self
    {
        if (!$this->volumeSellProducts->contains($volumeSellProduct)) {
            if ($volumeSellProduct->getProduct() !== $this) {
                $volumeSellProduct->setProduct($this);
            }

            $this->volumeSellProducts->add($volumeSellProduct);
        }

        return $this;
    }

    public function removeVolumeSellProduct(ProductVolumeSellProduct $volumeSellProduct): self
    {
        if ($this->volumeSellProducts->contains($volumeSellProduct)) {
            $this->volumeSellProducts->removeElement($volumeSellProduct);
        }

        return $this;
    }

    protected function toProductCategoryProductEntity(array $data): ProductCategoryProduct
    {
        $data = $data['product_category'];

        $id = null;
        $title = $data['title'];
        $pattern = '/\/product_categories\/(?\'category_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['category_id'])) {
                $id = (int)$matches['category_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine product category id!');
        }

        $category = (new ProductCategory)->setProductCategoryId($id)->setTitle($title);

        return (new ProductCategoryProduct())
            ->setProduct($this)
            ->setProductCategory($category);
    }

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
            throw new LogicException('Could not determine cross-sell product id!');
        }

        $crossSellProduct = (new Product)->setProductId($id)->setTitle($title);

        return (new ProductCrossSellProduct)
            ->setProduct($this)
            ->setCrossSellProduct($crossSellProduct);
    }

    protected function toProductUpSellProductEntity(array $data): ProductUpSellProduct
    {
        $id = null;
        $title = $data['title'];
        $pattern = '/.*\/[a-zA-Z]+=(?\'product_id\'[\d]+);[a-zA-Z]+=(?\'up_sell_product_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['up_sell_product_id'])) {
                $id = (int)$matches['up_sell_product_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine up-sell product id!');
        }

        $upSellProduct = (new Product)->setProductId($id)->setTitle($title);

        return (new ProductUpSellProduct)
            ->setProduct($this)
            ->setUpSellProduct($upSellProduct);
    }

    protected function toProductVolumeSellProductEntity(array $data): ProductVolumeSellProduct
    {
        $id = null;
        $title = $data['title'];
        $pattern = '/.*\/[a-zA-Z]+=(?\'product_id\'[\d]+);[a-zA-Z]+=(?\'volume_sell_product_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['volume_sell_product_id'])) {
                $id = (int)$matches['volume_sell_product_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine volume-sell product id!');
        }

        $volumeSellProduct = (new Product)->setProductId($id)->setTitle($title);

        return (new ProductVolumeSellProduct)
            ->setProduct($this)
            ->setVolumeSellProduct($volumeSellProduct);
    }

    protected function toProductReviewEntity(array $data): ProductReview
    {
        $id = null;
        $score = $data['score'];
        $title = $data['title'];
        $customer = $data['customer'] ? $this->iriToCustomerEntity($data['customer']) : null; // IRI
        $pattern = '/\/product_reviews\/(?\'review_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['review_id'])) {
                $id = (int)$matches['review_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine product review id!');
        }

        return (new ProductReview)
            ->setProductReviewId($id)
            ->setTitle($title)
            ->setScore($score)
            ->setCustomer($customer);
    }

    protected function iriToCustomerEntity(string $iri): Customer
    {
        $id = (int)str_replace('/customers/', '', $iri);
        return (new Customer)->setCustomerId($id);
    }
}
