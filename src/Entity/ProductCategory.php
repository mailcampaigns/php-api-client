<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;

class ProductCategory implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    /**
     * The unique numeric identifier for the product category.
     *
     * @var int
     */
    protected $productCategoryId;

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
     * Product category visibility.
     *
     * @var bool|null
     */
    protected $isVisible;

    /**
     * The title of the product category. <i>(Example: "T-shirt")</i>
     *
     * @var string
     */
    protected $title;

    /**
     * External unique reference for this category (for example the ID in your database).
     *
     * @var string
     */
    protected $categoryRef;

    /**
     * @var ProductProductCategoryCollection
     */
    protected $productProductCategories;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->productProductCategories = new ProductProductCategoryCollection;
    }

    /**
     * @return int|null
     */
    public function getProductCategoryId(): ?int
    {
        return $this->productCategoryId;
    }

    /**
     * @param int|null $productCategoryId
     * @return ProductCategory
     */
    public function setProductCategoryId(?int $productCategoryId): self
    {
        $this->productCategoryId = $productCategoryId;
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
     * @param bool|null $isVisible
     * @return ProductCategory
     */
    public function setIsVisible(?bool $isVisible): self
    {
        $this->isVisible = $isVisible;
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
     * @return ProductCategory
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryRef(): ?string
    {
        return $this->categoryRef;
    }

    /**
     * @param string|null $categoryRef
     * @return ProductCategory
     */
    public function setCategoryRef(?string $categoryRef): self
    {
        $this->categoryRef = $categoryRef;
        return $this;
    }

    public function getProductProductCategories(): ProductProductCategoryCollection
    {
        return $this->productProductCategories;
    }

    public function setProductProductCategories($productProductCategories): self
    {
        $this->productProductCategories = new ProductProductCategoryCollection;

        foreach ($productProductCategories as $productProductCategory) {
            $this->addProductProductCategory($productProductCategory);
        }

        return $this;
    }

    public function addProductProductCategory($productProductCategory): self
    {
        $entity = null;

        if (is_array($productProductCategory) && is_string($productProductCategory['product'])) {
            $pattern = '/\/products\/(?\'id\'[\d]+)/';

            if (false !== preg_match($pattern, $productProductCategory['product'], $matches)
                && isset($matches['id'])) {
                $id = (int)$matches['id'];

                $entity = (new ProductProductCategory)
                    ->setProductCategory($this)
                    ->setProduct(
                        (new Product)->setProductId($id)
                    );
            }
        }

        if ($entity instanceof ProductProductCategory) {
            if (!$this->productProductCategories->contains($entity)) {
                if (!$entity->getProductCategory()) {
                    $entity->setProductCategory($this);
                }

                $this->productProductCategories->add($entity);
            }
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'product_category_id' => $this->getProductCategoryId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'is_visible' => $this->getIsVisible(),
            'title' => $this->getTitle(),
            'category_ref' => $this->getCategoryRef(),
            'products' => $this->getProductProductCategories()->toArray($operation)
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): ?string
    {
        if (null === $this->getProductCategoryId()) {
            return null;
        }

        return '/product_categories/' . $this->getProductCategoryId();
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->productProductCategories);
    }
}
