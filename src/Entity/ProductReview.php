<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

class ProductReview implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    /**
     * The unique numeric identifier for the product review.
     *
     * @var int
     */
    protected $productReviewId;

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
     * Product review visibility.
     *
     * @var bool|null
     */
    protected $isVisible;

    /**
     * Review score. <i>(Example: 4)</i>
     *
     * @var int|null
     */
    protected $score;

    /**
     * The title of the review. <i>(Example: "Very nice product!")</i>
     *
     * @var string|null
     */
    protected $title;

    /**
     * Name of the reviewer. (Example: "John Smit")
     *
     * @var string
     */
    protected $name;

    /**
     * Email address of the reviewer.
     *
     * @var string
     */
    protected $emailAddress;

    /**
     * The content of the review.
     *
     * @var string|null
     */
    protected $content;

    /**
     * The language of the review. <i>(Example: "EN" for English)</i>
     *
     * @var string|null
     */
    protected $language;

    /**
     * Customer that added this review.
     *
     * @var Customer|null
     */
    protected $customer;

    /**
     * Product that is being reviewed.
     *
     * @var Product
     */
    protected $product;

    public function __construct()
    {
        $this->createdAt = new DateTime;
    }

    /**
     * @return int
     */
    public function getProductReviewId(): int
    {
        return $this->productReviewId;
    }

    /**
     * @param int $productReviewId
     * @return $this
     */
    public function setProductReviewId(int $productReviewId): self
    {
        $this->productReviewId = $productReviewId;
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
     * @return $this
     */
    public function setIsVisible(?bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @param int|null $score
     * @return $this
     */
    public function setScore(?int $score): self
    {
        $this->score = $score;
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
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @param string|null $emailAddress
     * @return $this
     */
    public function setEmailAddress(?string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
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
     * @return $this
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return $this
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     * @return $this
     */
    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
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
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
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
            'product' => $this->getProduct() ? $this->getProduct()->toIri() : null
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
        unset($this->product);
        unset($this->createdAt);
        unset($this->customer);
    }
}
