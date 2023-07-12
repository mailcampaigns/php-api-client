<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\ProductCategory;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class ProductCategoryApi extends AbstractApi
{
    const ORDERABLE_PARAMS = [
        'product_category_id',
        'created_at',
        'updated_at'
    ];

    const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    /**
     * {@inheritDoc}
     * @param ProductCategory|EntityInterface $entity
     * @return ProductCategory
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductCategory::class);
        $res = $this->post('product_categories', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return ProductCategory
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_categories/{$id}"));
    }

    /**
     * Find a product category by reference. Returns null when product category
     * could not be found.
     *
     * @param string $ref
     * @return ProductCategory|null
     * @throws HttpClientExceptionInterface
     */
    public function getByCategoryRef(string $ref): ?ProductCategory
    {
        $data = $this->handleSingleItemResponse(
            $this->get('product_categories', ['category_ref' => $ref])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Product category was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return ProductCategoryCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null,
                                  ?array $order = null): CollectionInterface
    {
        $data = $this->get('product_categories', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, ProductCategoryCollection::class);
    }

    /**
     * {@inheritDoc}
     * @param ProductCategory|EntityInterface $entity
     * @return ProductCategory
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, ProductCategory::class);

        $res = $this->put("product_categories/{$entity->getProductCategoryId()}", $entity);

        return $this->toEntity($res);
    }


    public function deleteById($id): ApiInterface
    {
        $this->delete("product_categories/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return ProductCategory
     */
    public function toEntity(array $data): EntityInterface
    {
        $productProductCategories = new ProductProductCategoryCollection($data['products'] ?? []);

        return (new ProductCategory)
            ->setProductCategoryId($data['product_category_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setTitle($data['title'])
            ->setCategoryRef($data['category_ref'])
            ->setProductProductCategories($productProductCategories);
    }
}
