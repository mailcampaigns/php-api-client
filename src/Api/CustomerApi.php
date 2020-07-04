<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerCollection;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\QuoteCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;


class CustomerApi extends AbstractApi
{
    /**
     * @param EntityInterface $entity
     * @return $this
     */
    public function create(EntityInterface $entity): self
    {
        $res = $this->post('customers', $entity->toArray(), [
            'content-type: application/json'
        ]);

        return $this;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getById(int $id): EntityInterface
    {
        return $this->toEntity($this->get("customers/{$id}"));
    }

    /**
     * @param string $customerRef
     * @return Customer|null
     */
    public function getByCustomerRef(string $customerRef): ?EntityInterface
    {
        $res = $this->get("customers", ['customer_ref' => $customerRef]);

        if (isset($res['hydra:totalItems'])) {
            if ((int)$res['hydra:totalItems'] > 0) {
                return $this->toEntity($res['hydra:member'][0]);
            }
        }

        return null;
    }

    /**
     * @param int|null $page
     * @param int|null $perPage
     * @return CustomerCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new CustomerCollection;

        $parameters = [
            'page' => $page ?? $this->page,
            'itemsPerPage' => $perPage ?? $this->perPage
        ];

        $data = $this->get('customers', $parameters);

        foreach ($data['hydra:member'] as $customerData) {
            $customer = $this->toEntity($customerData);
            $collection->add($customer);
        }

        return $collection;
    }

    /**
     * Updates a customer.
     *
     * @param EntityInterface $entity
     * @return $this
     */
    public function update(EntityInterface $entity): self
    {
        $this->put("customers/{$entity->getCustomerId()}", $entity->toArray(), [
            'content-type: application/json'
        ]);

        return $this;
    }

    /**
     * Deletes a customer by id.
     *
     * @param int $id
     * @return $this
     */
    public function deleteById(int $id): self
    {
        $this->delete("customers/{$id}");
        return $this;
    }

    /**
     * @param array $data
     * @return Customer
     */
    public function toEntity(array $data): EntityInterface
    {
        $orders = new OrderCollection($data['orders']);
        $productReviews = new ProductReviewCollection($data['product_reviews']);
        $favorites = new CustomerFavoriteProductCollection($data['favorites']);
        $quotes = new QuoteCollection($data['favorites']);


        return (new Customer)
            ->setCustomerId($data['customer_id'])
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setCustomerRef($data['customer_ref'])
            ->setOrigin($data['origin'])
            ->setIsSubscribed($data['is_subscribed'])
            ->setIsConfirmed($data['is_confirmed'])
            ->setGender($data['gender'])
            ->setBirthDate($this->toDtObject($data['birth_date']))
            ->setEmail($data['email'])
            ->setFirstName($data['first_name'])
            ->setLastName($data['last_name'])
            ->setPhone($data['phone'])
            ->setMobile($data['mobile'])
            ->setCompanyName($data['company_name'])
            ->setCompanyCocNumber($data['company_coc_number'])
            ->setCompanyVatNumber($data['company_vat_number'])
            ->setAddressBillingName($data['address_billing_name'])
            ->setAddressBillingStreet($data['address_billing_street'])
            ->setAddressBillingNumber($data['address_billing_number'])
            ->setAddressBillingExtension($data['address_billing_extension'])
            ->setAddressBillingZipcode($data['address_billing_zipcode'])
            ->setAddressBillingCity($data['address_billing_city'])
            ->setAddressBillingRegion($data['address_billing_region'])
            ->setAddressBillingCountry($data['address_billing_country'])
            ->setAddressShippingCompany($data['address_shipping_company'])
            ->setAddressShippingName($data['address_shipping_name'])
            ->setAddressShippingStreet($data['address_shipping_street'])
            ->setAddressShippingNumber($data['address_shipping_number'])
            ->setAddressShippingExtension($data['address_shipping_extension'])
            ->setAddressShippingZipcode($data['address_shipping_zipcode'])
            ->setAddressShippingCity($data['address_shipping_city'])
            ->setAddressShippingRegion($data['address_shipping_region'])
            ->setAddressShippingCountry($data['address_shipping_country'])
            ->setLanguage($data['language'])
            ->setOrders($orders)
            ->setProductReviews($productReviews)
            ->setFavorites($favorites)
            ->setQuotes($quotes);
    }
}
