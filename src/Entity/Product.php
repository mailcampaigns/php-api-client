<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\ProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
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
     * The type of discount that applies to this product.
     *
     * @var string|null
     */
    protected $discountType;

    /**
     * The discount in percentage. (Example: 0.1366867)
     *
     * @var float|null
     */
    protected $discountPercentage;

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
     * @var ProductCustomFieldCollection
     */
    protected $customFields;

    /**
     * Products nested under this product.
     *
     * @var ProductCollection
     */
    protected $children;

    /**
     * The parent product.
     *
     * @var Product|null
     */
    protected $parent;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->isVisible = true;
        $this->reviews = new ProductReviewCollection;
        $this->categories = new ProductProductCategoryCollection;
        $this->relatedProducts = new ProductRelatedProductCollection;
        $this->crossSellProducts = new ProductCrossSellProductCollection;
        $this->upSellProducts = new ProductUpSellProductCollection;
        $this->volumeSellProducts = new ProductVolumeSellProductCollection;
        $this->customFields = new ProductCustomFieldCollection;
        $this->children = new ProductCollection;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     * @return Product
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Product
     */
    public function setTitle(?string $title): self
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
     * @param string|null $visibility
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
     * @param string|null $url
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
    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    /**
     * @param string|null $discountType
     * @return $this
     */
    public function setDiscountType(?string $discountType): self
    {
        $this->discountType = $discountType;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    /**
     * @param float|null $discountPercentage
     * @return Product
     */
    public function setDiscountPercentage(?float $discountPercentage): Product
    {
        $this->discountPercentage = $discountPercentage;
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
     * @param int|null $stockCount
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

    public function getCategories(): ProductProductCategoryCollection
    {
        return $this->categories;
    }

    public function setCategories(ProductProductCategoryCollection $collection): self
    {
        $this->categories = new ProductProductCategoryCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductProductCategory) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductProductCategory($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductProductCategory($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

            $this->addCategory($entity);
        }

        return $this;
    }

    public function addCategory(ProductProductCategory $ProductProductCategory): self
    {
        if (!$this->categories->contains($ProductProductCategory)) {
            if ($ProductProductCategory->getProduct() !== $this) {
                $ProductProductCategory->setProduct($this);
            }

            $this->categories->add($ProductProductCategory);
        }

        return $this;
    }

    public function removeCategory(ProductProductCategory $ProductProductCategory): self
    {
        if ($this->categories->contains($ProductProductCategory)) {
            $this->categories->removeElement($ProductProductCategory);
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
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductRelatedProduct) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductRelatedProduct($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductRelatedProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

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
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductReview) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductReview($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductReview($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

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
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductCrossSellProduct) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductCrossSellProduct($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductCrossSellProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

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
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductUpSellProduct) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductUpSellProduct($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductUpSellProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

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
            // Convert to entity if raw data (array) or IRI for the item is svolumeplied.
            if ($element instanceof ProductVolumeSellProduct) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProductVolumeSellProduct($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProductVolumeSellProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

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

    /**
     * @return ProductCustomFieldCollection
     */
    public function getCustomFields(): ProductCustomFieldCollection
    {
        return $this->customFields;
    }

    /**
     * @param iterable|ProductCustomFieldCollection|null $customFields
     * @return $this
     */
    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new ProductCustomFieldCollection;

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof ProductCustomField) {
                    $customField = $data;
                } else if (is_array($data)) {
                    $customField = (new ProductCustomField)
                        ->setCustomFieldId($data['custom_field_id'])
                        ->setProduct($this)
                        ->setName($data['name'])
                        ->setValue($data['value']);
                } else if (is_string($data)) {
                    // Convert customField IRI to a customField entity.
                    $customField = $this->iriToProductCustomFieldEntity($data);
                } else {
                    throw new LogicException('Custom field is of an unexpected type!');
                }

                $this->addCustomField($customField);
            }
        }

        return $this;
    }

    public function addCustomField(ProductCustomField $customField): self
    {
        if (!$this->customFields->contains($customField)) {
            if ($customField->getProduct() !== $this) {
                $customField->setProduct($this);
            }

            $this->customFields->add($customField);
        }

        return $this;
    }

    public function removeCustomField(ProductCustomField $customField): self
    {
        if ($this->customFields->contains($customField)) {
            $customField->setProduct(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    /**
     * @return ProductCollection
     */
    public function getChildren(): ProductCollection
    {
        return $this->children;
    }

    /**
     * @param ProductCollection $collection
     * @return $this
     */
    public function setChildren(ProductCollection $collection): self
    {
        $this->children = new ProductCollection;

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof Product) {
                $entity = $element;
            } else if (is_array($element)) {
                $entity = $this->toProduct($element);
            } else if (is_string($element)) {
                $entity = $this->iriToProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

            $this->addChild($entity);
        }

        return $this;
    }

    /**
     * @param Product $child
     * @return $this
     */
    public function addChild(Product $child): self
    {
        if (!$this->children->contains($child)) {
            $child->setParent($this);
            $this->children->add($child);
        }

        return $this;
    }

    /**
     * @param Product $child
     * @return $this
     */
    public function removeChild(Product $child): self
    {
        if ($this->children->contains($child)) {
            $child->setParent(null);
            $this->children->removeElement($child);
        }

        return $this;
    }

    /**
     * @return Product|null
     */
    public function getParent(): ?Product
    {
        return $this->parent;
    }

    /**
     * @param Product|null $parent
     * @return Product
     */
    public function setParent(?Product $parent): Product
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
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
            'discount_type' => $this->getDiscountType(),
            'discount_percentage' => $this->getDiscountPercentage(),
            'stock_status' => $this->getStockStatus(),
            'stock_count' => $this->getStockCount(),
            'tax' => $this->getTax(),
            'tax_rate' => $this->getTaxRate(),
            'categories' => $this->getCategories()->toArray($operation),
            'related_products' => $this->getRelatedProducts()->toArray($operation),
            'cross_sell_products' => $this->getCrossSellProducts()->toArray($operation),
            'up_sell_products' => $this->getUpSellProducts()->toArray($operation),
            'volume_sell_products' => $this->getVolumeSellProducts()->toArray($operation),
            'reviews' => $this->getReviews()->toArray($operation),
            'custom_fields' => $this->getCustomFields()->toArray($operation),
            'children' => $this->getChildren()->toArray($operation),
            'parent' => $this->getParent() ? $this->getParent()->toIri() : null
        ];
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        if (null === $this->getProductId()) {
            return null;
        }

        return '/products/' . $this->getProductId();
    }

    protected function toProductProductCategory(array $data): ProductProductCategory
    {
        $id = $title = $isVisible = $categoryRef = null;

        if (isset($data['product_category'])) {
            $data = $data['product_category'];
        }

        if (is_int($data)) {
            $id = $data;
        } else if (is_string($data)) {
            $pattern = '/\/product_categories\/(?\'id\'[\d]+)/';

            if (false !== preg_match($pattern, $data, $matches) && isset($matches['id'])) {
                $id = (int)$matches['id'];
            }
        } else {
            $id = isset($data['product_category_id']) ? (int)$data['product_category_id'] : null;
            $title = $data['title'] ?? null;
            $isVisible = $data['is_visible'] ?? null;
            $categoryRef = $data['category_ref'] ?? null;
        }

        if (null === $id) {
            throw new LogicException('Could not determine id!');
        }

        return (new ProductProductCategory)
            ->setProduct($this)
            ->setProductCategory(
                (new ProductCategory)
                    ->setProductCategoryId($id)
                    ->setTitle($title)
                    ->setCategoryRef($categoryRef)
                    ->setIsVisible($isVisible)
            );
    }

    protected function iriToProductProductCategory(string $iri): ProductProductCategory
    {
        $categoryId = $productId = null;

        $pattern = '/^\/product_product_categories\/product=(?\'product_id\'[\d]+);productCategory=(?\'category_id\'[\d]+)$/';

        if (false !== preg_match($pattern, $iri, $matches)) {
            if (isset($matches['category_id'])) {
                $categoryId = (int)$matches['category_id'];
            }

            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }
        }

        if (null === $categoryId || null === $productId) {
            throw new LogicException('IRI error: Could not determine product and/or category id!');
        }

        if ($productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $category = (new ProductCategory)->setProductCategoryId($categoryId);

        return (new ProductProductCategory)
            ->setProduct($this)
            ->setProductCategory($category);
    }

    protected function toProductRelatedProduct(array $data): ProductRelatedProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductRelatedProduct)
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProductRelatedProduct(string $iri): ProductRelatedProduct
    {
        $relatedProductId = $productId = null;
        // IRI example: "/product_related_products/product=4;relatedProduct=1"
        $pattern = '/^\/product_related_products\/product=(?\'product_id\'[\d]+);relatedProduct=(?\'related_product_id\'[\d]+)$/';

        if (false !== preg_match($pattern, $iri, $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }

            if (isset($matches['related_product_id'])) {
                $relatedProductId = (int)$matches['related_product_id'];
            }
        }

        if (null === $relatedProductId || null === $productId) {
            throw new LogicException('IRI error: Could not determine product and/or related product id!');
        }

        if ((int)$productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $relatedProduct = (new Product)->setProductId($relatedProductId);

        return (new ProductRelatedProduct)
            ->setProduct($this)
            ->setLinkedProduct($relatedProduct);
    }

    protected function toProductCrossSellProduct(array $data): ProductCrossSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductCrossSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProductCrossSellProduct(string $iri): ProductCrossSellProduct
    {
        $crossSellProductId = $productId = null;
        // IRI example: "/product_cross_sell_products/product=4;crossSellProduct=1"
        $pattern = '/^\/product_cross_sell_products\/product=(?\'product_id\'[\d]+);crossSellProduct=(?\'cross_sell_product_id\'[\d]+)$/';

        if (false !== preg_match($pattern, $iri, $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }

            if (isset($matches['cross_sell_product_id'])) {
                $crossSellProductId = (int)$matches['cross_sell_product_id'];
            }
        }

        if (null === $crossSellProductId || null === $productId) {
            throw new LogicException('IRI error: Could not determine product and/or cross-sell product id!');
        }

        if ((int)$productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $crossSellProduct = (new Product)->setProductId($crossSellProductId);

        return (new ProductCrossSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($crossSellProduct);
    }

    protected function toProductUpSellProduct(array $data): ProductUpSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductUpSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProductUpSellProduct(string $iri): ProductUpSellProduct
    {
        $upSellProductId = $productId = null;
        // IRI example: "/product_up_sell_products/product=4;upSellProduct=1"
        $pattern = '/^\/product_up_sell_products\/product=(?\'product_id\'[\d]+);upSellProduct=(?\'up_sell_product_id\'[\d]+)$/';

        if (false !== preg_match($pattern, $iri, $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }

            if (isset($matches['up_sell_product_id'])) {
                $upSellProductId = (int)$matches['up_sell_product_id'];
            }
        }

        if (null === $upSellProductId || null === $productId) {
            throw new LogicException('IRI error: Could not determine product and/or up-sell product id!');
        }

        if ((int)$productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $upSellProduct = (new Product)->setProductId($upSellProductId);

        return (new ProductUpSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($upSellProduct);
    }

    protected function toProductVolumeSellProduct(array $data): ProductVolumeSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductVolumeSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    protected function iriToProductVolumeSellProduct(string $iri): ProductVolumeSellProduct
    {
        $volumeSellProductId = $productId = null;
        // IRI example: "/product_volume_sell_products/product=4;volumeSellProduct=1"
        $pattern = '/^\/product_volume_sell_products\/product=(?\'product_id\'[\d]+);volumeSellProduct=(?\'volume_sell_product_id\'[\d]+)$/';

        if (false !== preg_match($pattern, $iri, $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }

            if (isset($matches['volume_sell_product_id'])) {
                $volumeSellProductId = (int)$matches['volume_sell_product_id'];
            }
        }

        if (null === $volumeSellProductId || null === $productId) {
            throw new LogicException('IRI error: Could not determine product and/or volume-sell product id!');
        }

        if ((int)$productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $volumeSellProduct = (new Product)->setProductId($volumeSellProductId);

        return (new ProductVolumeSellProduct)
            ->setProduct($this)
            ->setLinkedProduct($volumeSellProduct);
    }

    protected function toProduct(array $data): Product
    {
        $id = null;
        $pattern = '/\/products\/(?\'id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['id'])) {
                $id = (int)$matches['id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine product id!');
        }

        return (new Product)->setProductId($id);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }

    protected function toProductReview(array $data): ProductReview
    {
        $id = null;
        $score = $data['score'];
        $title = $data['title'];
        $customer = $data['customer'] ? $this->iriToCustomer($data['customer']) : null; // IRI
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

    protected function iriToProductReview(string $iri): ?ProductReview
    {
        $pattern = '/\/product_reviews\/(?\'id\'[\d]+)/';

        if (false !== preg_match($pattern, $iri, $matches) && isset($matches['id'])) {
            return (new ProductReview)->setProductReviewId((int)$matches['id']);
        }

        return null;
    }

    protected function iriToProductCustomFieldEntity(string $iri): ProductCustomField
    {
        $id = (int)str_replace('/product_custom_fields/', '', $iri);
        return (new ProductCustomField())->setCustomFieldId($id);
    }

    protected function iriToCustomer(string $iri): Customer
    {
        $id = (int)str_replace('/customers/', '', $iri);
        return (new Customer)->setCustomerId($id);
    }

    /**
     * Converts raw data to a linked product entity.
     * The raw data can be an array, IRI or just an ID.
     *
     * @param mixed $data
     * @return Product
     */
    protected function getLinkedProduct($data): Product
    {
        $linkedProduct = new Product;

        if (isset($data['linked_product'])) {
            $data = $data['linked_product'];
        }

        if (is_int($data)) {
            $linkedProduct->setProductId($data);
        } else if (is_string($data)) {
            $pattern = '/\/[a-z\_]+\/(?\'id\'[\d]+)/';

            if (false !== preg_match($pattern, $data, $matches)
                && isset($matches['id'])) {
                $linkedProduct->setProductId((int)$matches['id']);
            }
        } else if (is_array($data)) {
            $id = isset($data['product_id']) ? (int)$data['product_id'] : null;
            $isVisible = $data['is_visible'] ?? null;
            $url = $data['url'] ?? null;
            $title = $data['title'] ?? null;
            $brand = $data['brand'] ?? null;
            $image = $data['image'] ?? null;
            $articleCode = $data['article_code'] ?? null;
            $ean = $data['ean'] ?? null;
            $sku = $data['sku'] ?? null;

            $linkedProduct
                ->setProductId($id)
                ->setIsVisible($isVisible)
                ->setUrl($url)
                ->setTitle($title)
                ->setBrand($brand)
                ->setImage($image)
                ->setArticleCode($articleCode)
                ->setEan($ean)
                ->setSku($sku);
        }

        if (null === $linkedProduct->getProductId()) {
            throw new LogicException('Could not determine product id!');
        }

        return $linkedProduct;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->reviews);
        unset($this->categories);
        unset($this->relatedProducts);
        unset($this->crossSellProducts);
        unset($this->upSellProducts);
        unset($this->volumeSellProducts);
        unset($this->customFields);
        unset($this->children);
    }
}
