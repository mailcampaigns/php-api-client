<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductReview;

class ProductReviewApi implements ApiInterface
{
    use ApiTrait;

    /**
     * @api
     */
    public const ORDERABLE_PARAMS = [
        'product_review_id',
        'created_at',
        'updated_at'
    ];

    public const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    public function create(ProductReview|EntityInterface $entity): ProductReview
    {
        assert($entity instanceof ProductReview);
        return $this->toEntity($this->post('product_reviews', $entity));
    }

    public function getById(int|string $id): ProductReview
    {
        return $this->toEntity($this->get("product_reviews/$id"));
    }

    /**
     * Find a product review by reference. Returns null when product review
     * could not be found.
     *
     * @throws ApiClientException
     * @api
     */
    public function getByReviewRef(string $ref): ?ProductReview
    {
        $data = $this->handleSingleItemResponse(
            $this->get('product_reviews', ['review_ref' => $ref])
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null
    ): ProductReviewCollection {
        $data = $this->get('product_reviews', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        $collection = $this->toCollection($data, ProductReviewCollection::class);
        assert($collection instanceof ProductReviewCollection);

        return $collection;
    }

    public function update(ProductReview|EntityInterface $entity): ProductReview
    {
        assert($entity instanceof ProductReview);

        return $this->toEntity(
            $this->put("product_reviews/{$entity->getProductReviewId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("product_reviews/$id");
        return $this;
    }

    public function toEntity(array $data): ProductReview
    {
        $customer = $this->iriToCustomer($data['customer']);
        $product = $this->iriToProduct($data['product']);

        return (new ProductReview())
            ->setProductReviewId($data['product_review_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setCustomer($customer)
            ->setEmailAddress($data['email_address'])
            ->setProduct($product)
            ->setScore($data['score'])
            ->setLanguage($data['language'])
            ->setTitle($data['title'])
            ->setContent($data['content']);
    }

    protected function iriToCustomer(?string $iri): ?Customer
    {
        if (!$iri) {
            return null;
        }

        return (new Customer())->setCustomerId(
            (int)str_replace('/customers/', '', $iri)
        );
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        return (new Product())->setProductId(
            (int)str_replace('/products/', '', $iri)
        );
    }
}
