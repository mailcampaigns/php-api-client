<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerFavoriteProduct;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Exception\ApiException;

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
        $collection = new CustomerFavoriteProductCollection;

        $data = $this->get('customer_favorite_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        if (isset($data['hydra:member'])) {
            $arr = $data['hydra:member'];
        } else if (isset($data) && is_array($data)) {
            $arr = $data;
        } else {
            $arr = [];
        }

        foreach ($arr as $favoriteData) {
            $favorite = $this->toEntity($favoriteData);
            $collection->add($favorite);
        }

        return $collection;
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
