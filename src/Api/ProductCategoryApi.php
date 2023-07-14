<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\ProductCategoryCollection;
use MailCampaigns\ApiClient\Collection\ProductProductCategoryCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\ProductCategory;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class ProductCategoryApi extends AbstractApi
{
    public const ORDERABLE_PARAMS = [
        'product_category_id',
        'created_at',
        'updated_at'
    ];

    public const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    public function create(ProductCategory|EntityInterface $entity): ProductCategory
    {
        assert($entity instanceof ProductCategory);
        return $this->toEntity($this->post('product_categories', $entity));
    }

    public function getById(int|string $id): ProductCategory
    {
        return $this->toEntity($this->get("product_categories/$id"));
    }

    /**
     * Find a product category by reference. Returns null when product category
     * could not be found.
     *
     * @throws HttpClientExceptionInterface
     */
    public function getByCategoryRef(string $ref): ?ProductCategory
    {
        $data = $this->handleSingleItemResponse(
            $this->get('product_categories', ['category_ref' => $ref])
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null
    ): ProductCategoryCollection {
        $data = $this->get('product_categories', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        $collection = $this->toCollection($data, ProductCategoryCollection::class);
        assert($collection instanceof ProductCategoryCollection);

        return $collection;
    }

    public function update(ProductCategory|EntityInterface $entity): ProductCategory
    {
        assert($entity instanceof ProductCategory);

        return $this->toEntity(
            $this->put("product_categories/{$entity->getProductCategoryId()}", $entity)
        );
    }


    public function deleteById(int|string $id): self
    {
        $this->delete("product_categories/$id");
        return $this;
    }

    public function toEntity(array $data): ProductCategory
    {
        $productProductCategories = new ProductProductCategoryCollection($data['products'] ?? []);

        return (new ProductCategory())
            ->setProductCategoryId($data['product_category_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setIsVisible($data['is_visible'])
            ->setTitle($data['title'])
            ->setCategoryRef($data['category_ref'])
            ->setProductProductCategories($productProductCategories);
    }
}
