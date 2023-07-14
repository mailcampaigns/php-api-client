<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\ProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCrossSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductRelatedProductCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\ProductUpSellProductCollection;
use MailCampaigns\ApiClient\Collection\ProductVolumeSellProductCollection;

class Product implements EntityInterface, CustomFieldAwareEntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    public function __construct(
        private ?int $productId = null,
        private ?string $title = null,
        private ?int $stockCount = null,
        private ?float $tax = null,
        private ?bool $isVisible = true,
        private ?string $visibility = null,
        private ?string $url = null,
        private ?string $fullTitle = null,
        private ?string $brand = null,
        private ?string $description = null,
        private ?string $content = null,
        private ?string $image = null,
        private ?string $articleCode = null,
        private ?string $ean = null,
        private ?string $sku = null,
        private ?float $priceCost = null,
        private ?float $priceExcl = null,
        private ?float $priceIncl = null,
        private ?float $oldPriceExcl = null,
        private ?float $oldPriceIncl = null,
        private ?string $discountType = null,
        private ?float $discountPercentage = null,
        private ?string $stockStatus = null,
        private ?float $taxRate = null,
        private ?Product $parent = null,
        private ProductProductCategoryCollection $categories = new ProductProductCategoryCollection(),
        private ProductRelatedProductCollection $relatedProducts = new ProductRelatedProductCollection(),
        private ProductCrossSellProductCollection $crossSellProducts = new ProductCrossSellProductCollection(),
        private ProductUpSellProductCollection $upSellProducts = new ProductUpSellProductCollection(),
        private ProductVolumeSellProductCollection $volumeSellProducts = new ProductVolumeSellProductCollection(),
        private ProductReviewCollection $reviews = new ProductReviewCollection(),
        private ProductCustomFieldCollection $customFields = new ProductCustomFieldCollection(),
        private ProductCollection $children = new ProductCollection(),
    ) {
        $this->createdAt = new DateTime();
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getIsVisible(): bool
    {
        return true === $this->isVisible;
    }

    public function setIsVisible(?bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(?string $visibility): self
    {
        $this->visibility = $visibility;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getFullTitle(): ?string
    {
        return $this->fullTitle;
    }

    public function setFullTitle(?string $fullTitle): self
    {
        $this->fullTitle = $fullTitle;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
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

    public function getOldPriceExcl(): ?float
    {
        return $this->oldPriceExcl;
    }

    public function setOldPriceExcl(?float $oldPriceExcl): self
    {
        $this->oldPriceExcl = $oldPriceExcl;
        return $this;
    }

    public function getOldPriceIncl(): ?float
    {
        return $this->oldPriceIncl;
    }

    public function setOldPriceIncl(?float $oldPriceIncl): self
    {
        $this->oldPriceIncl = $oldPriceIncl;
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

    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(?float $discountPercentage): Product
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    public function getStockStatus(): ?string
    {
        return $this->stockStatus;
    }

    public function setStockStatus(?string $stockStatus): self
    {
        $this->stockStatus = $stockStatus;
        return $this;
    }

    public function getStockCount(): ?int
    {
        return $this->stockCount;
    }

    public function setStockCount(?int $stockCount): self
    {
        $this->stockCount = $stockCount;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(?float $tax): self
    {
        $this->tax = $tax;
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

    public function getCategories(): ProductProductCategoryCollection
    {
        return $this->categories;
    }

    public function setCategories(ProductProductCategoryCollection $collection): self
    {
        $this->categories = new ProductProductCategoryCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductProductCategory) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductProductCategory($element);
            } elseif (is_string($element)) {
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
        $this->relatedProducts = new ProductRelatedProductCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductRelatedProduct) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductRelatedProduct($element);
            } elseif (is_string($element)) {
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
        $this->reviews = new ProductReviewCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductReview) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductReview($element);
            } elseif (is_string($element)) {
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
        $this->crossSellProducts = new ProductCrossSellProductCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductCrossSellProduct) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductCrossSellProduct($element);
            } elseif (is_string($element)) {
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
        $this->upSellProducts = new ProductUpSellProductCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof ProductUpSellProduct) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductUpSellProduct($element);
            } elseif (is_string($element)) {
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
        $this->volumeSellProducts = new ProductVolumeSellProductCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is svolumeplied.
            if ($element instanceof ProductVolumeSellProduct) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProductVolumeSellProduct($element);
            } elseif (is_string($element)) {
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

    public function getCustomFields(): ProductCustomFieldCollection
    {
        return $this->customFields;
    }

    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new ProductCustomFieldCollection();

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof ProductCustomField) {
                    $customField = $data;
                } elseif (is_array($data)) {
                    $customField = (new ProductCustomField())
                        ->setCustomFieldId($data['custom_field_id'])
                        ->setProduct($this)
                        ->setName($data['name'])
                        ->setValue($data['value']);
                } elseif (is_string($data)) {
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

    public function addCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
    {
        assert($customField instanceof ProductCustomField);

        if (!$this->customFields->contains($customField)) {
            if ($customField->getProduct() !== $this) {
                $customField->setProduct($this);
            }

            $this->customFields->add($customField);
        }

        return $this;
    }

    public function removeCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
    {
        assert($customField instanceof ProductCustomField);

        if ($this->customFields->contains($customField)) {
            $customField->setProduct(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    public function getChildren(): ProductCollection
    {
        return $this->children;
    }

    public function setChildren(ProductCollection $collection): self
    {
        $this->children = new ProductCollection();

        foreach ($collection as $element) {
            // Convert to entity if raw data (array) or IRI for the item is supplied.
            if ($element instanceof Product) {
                $entity = $element;
            } elseif (is_array($element)) {
                $entity = $this->toProduct($element);
            } elseif (is_string($element)) {
                $entity = $this->iriToProduct($element);
            } else {
                throw new LogicException('Unexpected element type in collection!');
            }

            $this->addChild($entity);
        }

        return $this;
    }

    public function addChild(Product $child): self
    {
        if (!$this->children->contains($child)) {
            $child->setParent($this);
            $this->children->add($child);
        }

        return $this;
    }

    public function removeChild(Product $child): self
    {
        if ($this->children->contains($child)) {
            $child->setParent(null);
            $this->children->removeElement($child);
        }

        return $this;
    }

    public function getParent(): ?Product
    {
        return $this->parent;
    }

    public function setParent(?Product $parent): Product
    {
        $this->parent = $parent;
        return $this;
    }

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
            'parent' => $this->getParent()?->toIri()
        ];
    }


    public function toIri(): ?string
    {
        if (null === $this->getProductId()) {
            return null;
        }

        return '/products/' . $this->getProductId();
    }

    private function toProductProductCategory(array $data): ProductProductCategory
    {
        $id = $title = $isVisible = $categoryRef = null;

        if (isset($data['product_category'])) {
            $data = $data['product_category'];
        }

        if (is_int($data)) {
            $id = $data;
        } elseif (is_string($data)) {
            $pattern = '/\/product_categories\/(?\'id\'\d+)/';

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

        return (new ProductProductCategory())
            ->setProduct($this)
            ->setProductCategory(
                (new ProductCategory())
                    ->setProductCategoryId($id)
                    ->setTitle($title)
                    ->setCategoryRef($categoryRef)
                    ->setIsVisible($isVisible)
            );
    }

    private function iriToProductProductCategory(string $iri): ProductProductCategory
    {
        $categoryId = $productId = null;

        $pattern = '/^\/product_product_categories\/product=(?\'product_id\'\d+);productCategory=(?\'category_id\'\d+)$/';

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

        $category = (new ProductCategory())->setProductCategoryId($categoryId);

        return (new ProductProductCategory())
            ->setProduct($this)
            ->setProductCategory($category);
    }

    private function toProductRelatedProduct(array $data): ProductRelatedProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductRelatedProduct())
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    private function iriToProductRelatedProduct(string $iri): ProductRelatedProduct
    {
        $relatedProductId = $productId = null;
        // IRI example: "/product_related_products/product=4;relatedProduct=1"
        $pattern = '/^\/product_related_products\/product=(?\'product_id\'\d+);relatedProduct=(?\'related_product_id\'\d+)$/';

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

        if ($productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $relatedProduct = (new Product())->setProductId($relatedProductId);

        return (new ProductRelatedProduct())
            ->setProduct($this)
            ->setLinkedProduct($relatedProduct);
    }

    private function toProductCrossSellProduct(array $data): ProductCrossSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductCrossSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    private function iriToProductCrossSellProduct(string $iri): ProductCrossSellProduct
    {
        $crossSellProductId = $productId = null;
        // IRI example: "/product_cross_sell_products/product=4;crossSellProduct=1"
        $pattern = '/^\/product_cross_sell_products\/product=(?\'product_id\'\d+);crossSellProduct=(?\'cross_sell_product_id\'\d+)$/';

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

        if ($productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $crossSellProduct = (new Product())->setProductId($crossSellProductId);

        return (new ProductCrossSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($crossSellProduct);
    }

    private function toProductUpSellProduct(array $data): ProductUpSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductUpSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    private function iriToProductUpSellProduct(string $iri): ProductUpSellProduct
    {
        $upSellProductId = $productId = null;
        // IRI example: "/product_up_sell_products/product=4;upSellProduct=1"
        $pattern = '/^\/product_up_sell_products\/product=(?\'product_id\'\d+);upSellProduct=(?\'up_sell_product_id\'\d+)$/';

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

        if ($productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $upSellProduct = (new Product())->setProductId($upSellProductId);

        return (new ProductUpSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($upSellProduct);
    }

    private function toProductVolumeSellProduct(array $data): ProductVolumeSellProduct
    {
        $linkedProduct = $this->getLinkedProduct($data);

        return (new ProductVolumeSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($linkedProduct);
    }

    private function iriToProductVolumeSellProduct(string $iri): ProductVolumeSellProduct
    {
        $volumeSellProductId = $productId = null;
        // IRI example: "/product_volume_sell_products/product=4;volumeSellProduct=1"
        $pattern = '/^\/product_volume_sell_products\/product=(?\'product_id\'\d+);volumeSellProduct=(?\'volume_sell_product_id\'\d+)$/';

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

        if ($productId !== $this->getProductId()) {
            throw new LogicException('IRI error: Product id does not match.');
        }

        $volumeSellProduct = (new Product())->setProductId($volumeSellProductId);

        return (new ProductVolumeSellProduct())
            ->setProduct($this)
            ->setLinkedProduct($volumeSellProduct);
    }

    private function toProduct(array $data): Product
    {
        $id = null;
        $pattern = '/\/products\/(?\'id\'\d+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['id'])) {
                $id = (int)$matches['id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine product id!');
        }

        return (new Product())->setProductId($id);
    }

    private function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product())->setProductId($id);
    }

    private function toProductReview(array $data): ProductReview
    {
        $id = null;
        $score = $data['score'];
        $title = $data['title'];
        $customer = $data['customer'] ? $this->iriToCustomer($data['customer']) : null; // IRI
        $pattern = '/\/product_reviews\/(?\'review_id\'\d+)/';

        if (false !== preg_match($pattern, $data['@id'], $matches)) {
            if (isset($matches['review_id'])) {
                $id = (int)$matches['review_id'];
            }
        }

        if (null === $id) {
            throw new LogicException('Could not determine product review id!');
        }

        return (new ProductReview())
            ->setProductReviewId($id)
            ->setTitle($title)
            ->setScore($score)
            ->setCustomer($customer);
    }

    private function iriToProductReview(string $iri): ?ProductReview
    {
        $pattern = '/\/product_reviews\/(?\'id\'\d+)/';

        if (false !== preg_match($pattern, $iri, $matches) && isset($matches['id'])) {
            return (new ProductReview())->setProductReviewId((int)$matches['id']);
        }

        return null;
    }

    private function iriToProductCustomFieldEntity(string $iri): ProductCustomField
    {
        $id = (int)str_replace('/product_custom_fields/', '', $iri);
        return (new ProductCustomField())->setCustomFieldId($id);
    }

    private function iriToCustomer(string $iri): Customer
    {
        $id = (int)str_replace('/customers/', '', $iri);
        return (new Customer())->setCustomerId($id);
    }

    /**
     * Converts raw data to a linked product entity.
     * The raw data can be an array, IRI or just an ID.
     */
    private function getLinkedProduct(int|string|array $data): self
    {
        $linkedProduct = new Product();

        if (isset($data['linked_product'])) {
            $data = $data['linked_product'];
        }

        if (is_int($data)) {
            $linkedProduct->setProductId($data);
        } elseif (is_string($data)) {
            $pattern = '/\/[a-z_]+\/(?\'id\'\d+)/';

            if (
                false !== preg_match($pattern, $data, $matches)
                && isset($matches['id'])
            ) {
                $linkedProduct->setProductId((int)$matches['id']);
            }
        } elseif (is_array($data)) {
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

    public function getNewCustomField(): CustomFieldInterface
    {
        return new ProductCustomField();
    }

    public function __clone()
    {
        $this->categories = clone $this->categories;
        $this->customFields = clone $this->customFields;
        $this->children = clone $this->children;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->categories);
        unset($this->relatedProducts);
        unset($this->crossSellProducts);
        unset($this->upSellProducts);
        unset($this->volumeSellProducts);
        unset($this->reviews);
        unset($this->customFields);
        unset($this->children);
        unset($this->parent);
    }
}
