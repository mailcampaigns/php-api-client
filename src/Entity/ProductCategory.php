<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\Collection\ProductCollection;

class ProductCategory implements EntityInterface
{
    use DateTrait;

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
     * Products that fall under this category.
     *
     * @var ProductCollection
     */
    protected $products;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->products = new ProductCollection;
    }

    /**
     * @return int
     */
    public function getProductCategoryId(): int
    {
        return $this->productCategoryId;
    }

    /**
     * @param int $productCategoryId
     * @return ProductCategory
     */
    public function setProductCategoryId(int $productCategoryId): self
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ProductCategory
     */
    public function setTitle(string $title): self
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

    public function getProducts(): ProductCollection
    {
        return $this->products;
    }

    public function setProducts(ProductCollection $products): self
    {
        $this->products = $products;
        return $this;
    }


    function toArray2(?string $operation = null): array
    {
        return [
            'product_category_id' => $this->getProductCategoryId(),
            'products' => $this->getProducts()->toArray($operation)
        ];
    }

    /**
     * @inheritDoc
     */
    function toArray(?string $operation = null): array
    {
        if ($operation !== ApiInterface::OPERATION_PUT) {
            return [
                'product_category_id' => $this->getProductCategoryId(),
                'title' => $this->getTitle()
            ];
        } else {
            return [
                'product_category_id' => $this->getProductCategoryId(),
                'products' => $this->getProducts()->toArray($operation)
            ];
        }
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        if (null === $this->getProductCategoryId()) {
            return '';
        }

        return $this->iri ?? '/product_categories/' . $this->getProductCategoryId();
    }
}
