<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductReview;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class ProductReviewApi extends AbstractApi
{
    const ORDERABLE_PARAMS = [
        'product_review_id',
        'created_at',
        'updated_at'
    ];

    const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    /**
     * {@inheritDoc}
     * @param ProductReview|EntityInterface $entity
     * @return ProductReview
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductReview::class);
        $res = $this->post('product_reviews', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return ProductReview
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_reviews/{$id}"));
    }

    /**
     * Find a product review by reference. Returns null when product review
     * could not be found.
     *
     * @param string $ref
     * @return ProductReview|null
     * @throws HttpClientExceptionInterface
     */
    public function getByReviewRef(string $ref): ?ProductReview
    {
        $data = $this->handleSingleItemResponse(
            $this->get('product_reviews', ['review_ref' => $ref])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Product review was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return ProductReviewCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null,
                                  ?array $order = null): CollectionInterface
    {
        $data = $this->get('product_reviews', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, ProductReviewCollection::class);
    }

    /**
     * {@inheritDoc}
     * @param ProductReview|EntityInterface $entity
     * @return ProductReview
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductReview::class);

        $res = $this->put("product_reviews/{$entity->getProductReviewId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("product_reviews/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductReview
     */
    public function toEntity(array $data): EntityInterface
    {
        $customer = $this->iriToCustomer($data['customer']);
        $product = $this->iriToProduct($data['product']);

        return (new ProductReview)
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

        $id = (int)str_replace('/customers/', '', $iri);

        return (new Customer)->setCustomerId($id);
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        $id = (int)str_replace('/products/', '', $iri);

        return (new Product)->setProductId($id);
    }
}
