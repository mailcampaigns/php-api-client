<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerFavoriteProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;

class CustomerFavoriteProductApi implements ApiInterface
{
    use ApiTrait;

    public function create(CustomerFavoriteProduct|EntityInterface $entity): CustomerFavoriteProduct
    {
        assert($entity instanceof CustomerFavoriteProduct);
        return $this->toEntity($this->post('customer_favorite_products', $entity));
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: customer=1;favoriteProduct=2
     */
    public function getById(int|string $id): CustomerFavoriteProduct
    {
        assert(is_string($id));
        return $this->toEntity($this->get("customer_favorite_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): CustomerFavoriteProductCollection {
        $data = $this->get('customer_favorite_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, CustomerFavoriteProductCollection::class);
        assert($collection instanceof CustomerFavoriteProductCollection);

        return $collection;
    }

    /**
     * @throws ApiClientException
     * @api
     */
    public function getCollectionByCustomerId(
        int $customerId,
        ?int $page = null,
        ?int $perPage = null
    ): CustomerFavoriteProductCollection {
        $data = $this->get("customers/$customerId/favorites", [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, CustomerFavoriteProductCollection::class);
        assert($collection instanceof CustomerFavoriteProductCollection);

        return $collection;
    }

    public function update(CustomerFavoriteProductCollection|EntityInterface $entity): EntityInterface
    {
        assert($entity instanceof CustomerFavoriteProduct);
        throw new ApiClientException('Operation not supported! Either create or delete this item.');
    }

    /**
     * {@inheritDoc}
     * @param string $id In this format: customer=1;favoriteProduct=2
     */
    public function deleteById(int|string $id): self
    {
        assert(is_string($id));
        $this->delete("customer_favorite_products/$id");
        return $this;
    }

    public function toEntity(array $data): CustomerFavoriteProduct
    {
        $customer = $this->iriToCustomer($data['customer']);
        $product = $this->iriToProduct($data['favorite_product']);

        return (new CustomerFavoriteProduct())
            ->setCustomer($customer)
            ->setProduct($product);
    }

    protected function iriToCustomer(?string $iri): ?Customer
    {
        if (!$iri) {
            return null;
        }

        return (new Customer())->setCustomerId((int)str_replace('/customers/', '', $iri));
    }

    protected function iriToProduct(?string $iri): ?Product
    {
        if (!$iri) {
            return null;
        }

        return (new Product())->setProductId((int)str_replace('/products/', '', $iri));
    }
}
