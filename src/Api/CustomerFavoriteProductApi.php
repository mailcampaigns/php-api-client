<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerFavoriteProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class CustomerFavoriteProductApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param CustomerFavoriteProduct|EntityInterface $entity
     * @return CustomerFavoriteProduct
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, CustomerFavoriteProduct::class);
        $res = $this->post('customer_favorite_products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: customer=1;favoriteProduct=2
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("customer_favorite_products/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return CustomerFavoriteProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('customer_favorite_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, CustomerFavoriteProductCollection::class);
    }

    /**
     * @param int      $customerId
     * @param int|null $page
     * @param int|null $perPage
     * @return CustomerFavoriteProductCollection
     * @throws HttpClientExceptionInterface
     */
    public function getCollectionByCustomerId(int $customerId, ?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get("customers/$customerId/favorites", [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, CustomerFavoriteProductCollection::class);
    }

    /**
     * {@inheritDoc}
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported! Either create or delete this item.');
    }

    /**
     * @inheritDoc
     * @param string $id In this format: customer=1;favoriteProduct=2
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("customer_favorite_products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return CustomerFavoriteProduct
     */
    public function toEntity(array $data): EntityInterface
    {
        $customer = $this->iriToCustomer($data['customer']);
        $product = $this->iriToProduct($data['favorite_product']);

        return (new CustomerFavoriteProduct)
            ->setCustomer($customer)
            ->setProduct($product);
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
