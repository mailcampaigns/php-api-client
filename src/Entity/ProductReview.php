<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

class ProductReview implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    public function __construct(
        private ?int $productReviewId = null,
        private ?bool $isVisible = null,
        private ?int $score = null,
        private ?string $title = null,
        private ?string $name = null,
        private ?string $emailAddress = null,
        private ?string $content = null,
        private ?string $language = null,
        private ?Customer $customer = null,
        private ?Product $product = null,
    ) {
        $this->createdAt = new DateTime;
    }

    public function getProductReviewId(): int
    {
        return $this->productReviewId;
    }

    public function setProductReviewId(int $productReviewId): self
    {
        $this->productReviewId = $productReviewId;
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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(?string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'product_review_id' => $this->productReviewId,
            'created_at' => $this->dtToString($this->createdAt),
            'updated_at' => $this->dtToString($this->updatedAt),
            'is_visible' => $this->isVisible,
            'score' => $this->score,
            'title' => $this->title,
            'name' => $this->name,
            'email_address' => $this->emailAddress,
            'content' => $this->content,
            'language' => $this->language,
            'customer' => $this->getCustomerIri(),
            'product' => $this->getProduct()?->toIri()
        ];
    }

    public function getCustomerIri(): ?string
    {
        if (!$this->getCustomer() instanceof Customer) {
            return null;
        }

        return $this->getCustomer()->toIri();
    }

    public function toIri(): ?string
    {
        if (null === $this->getProductReviewId()) {
            return null;
        }

        return '/product_reviews/' . $this->getProductReviewId();
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->customer);
        unset($this->product);
    }
}
