<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\ToJsonTrait;

class ProductCategory implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;
    use ToJsonTrait;

    public function __construct(
        private ?int $productCategoryId = null,
        private ?bool $isVisible = null,
        private ?string $title = null,
        private ?string $categoryRef = null,
        private ?ProductProductCategoryCollection $productProductCategories = new ProductProductCategoryCollection(),
    ) {
        $this->createdAt = new DateTime();
    }

    public function getProductCategoryId(): ?int
    {
        return $this->productCategoryId;
    }

    public function setProductCategoryId(?int $productCategoryId): self
    {
        $this->productCategoryId = $productCategoryId;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getCategoryRef(): ?string
    {
        return $this->categoryRef;
    }

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
        $this->productProductCategories = new ProductProductCategoryCollection();

        foreach ($productProductCategories as $productProductCategory) {
            $this->addProductProductCategory($productProductCategory);
        }

        return $this;
    }

    public function addProductProductCategory($productProductCategory): self
    {
        $entity = null;

        if (is_array($productProductCategory) && is_string($productProductCategory['product'])) {
            $pregMatchRes = preg_match(
                '/\/products\/(?\'id\'\d+)/',
                $productProductCategory['product'],
                $matches
            );

            if (false !== $pregMatchRes && isset($matches['id'])) {
                $id = (int)$matches['id'];

                $entity = (new ProductProductCategory())
                    ->setProductCategory($this)
                    ->setProduct(
                        (new Product())->setProductId($id)
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

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
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

    public function toIri(): ?string
    {
        if (null === $this->getProductCategoryId()) {
            return null;
        }

        return '/product_categories/' . $this->getProductCategoryId();
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->productProductCategories);
    }
}
