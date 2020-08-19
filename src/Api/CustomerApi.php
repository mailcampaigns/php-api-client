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

/**
 * @link https://docs.mailcampaigns.io/?version=latest#56216160-9758-47bc-a2cd-aebb6296fdb0
 */
class CustomerApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param Customer|EntityInterface $entity
     * @return Customer
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, Customer::class);
        $res = $this->post('customers', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return Customer
     */
    public function getById(int $id): EntityInterface
    {
        return $this->toEntity($this->get("customers/{$id}"));
    }

    /**
     * Tries to find a customer by reference, returns null when no customer was
     * found with the given customer reference.
     *
     * @param string $customerRef
     * @return Customer|null
     */
    public function getByCustomerRef(string $customerRef): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('customers', ['customer_ref' => $customerRef])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Customer was not found.
        return null;
    }

    /**
     * Tries to find a customer by email address, returns null if no customer was
     * found with the given email address.
     *
     * @param string $email
     * @return Customer|null
     */
    public function getByEmail(string $email): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('customers', ['email' => $email])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Customer was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return CustomerCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new CustomerCollection;

        $data = $this->get('customers', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        foreach ($data['hydra:member'] as $customerData) {
            $customer = $this->toEntity($customerData);
            $collection->add($customer);
        }

        return $collection;
    }

    /**
     * {@inheritDoc}
     * @param Customer|EntityInterface $entity
     * @return Customer
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, Customer::class);

        $res = $this->put("customers/{$entity->getCustomerId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): ApiInterface
    {
        $this->delete("customers/{$id}");
        return $this;
    }

    /**
     * @param array $data
     * @return Customer
     */
    public function toEntity($data): EntityInterface
    {
        if (is_string($data)) {
            print $data;exit;
        }

        $orders = new OrderCollection($data['orders']);
        $productReviews = new ProductReviewCollection($data['product_reviews']);
        $favorites = new CustomerFavoriteProductCollection($data['favorites']);
        $quotes = new QuoteCollection($data['quotes']);

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
