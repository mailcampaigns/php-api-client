<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerCollection;
use MailCampaigns\ApiClient\Collection\CustomerCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\QuoteCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;

class CustomerApi extends AbstractApi
{
    const ORDERABLE_PARAMS = [
        'customer_id',
        'created_at',
        'updated_at'
    ];

    const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

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
    public function getById($id): EntityInterface
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

    public function getByCustomerRefs(array $refs, ?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('customers', [
            'customer_ref' => $refs,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, CustomerCollection::class);
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

    public function getByEmails(array $emails, ?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('customers', [
            'email' => $emails,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, CustomerCollection::class);
    }

    /**
     * {@inheritDoc}
     * @return CustomerCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null, ?array $order = null): CollectionInterface
    {
        $data = $this->get('customers', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        return $this->toCollection($data, CustomerCollection::class);
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
    public function deleteById($id): ApiInterface
    {
        $this->delete("customers/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return Customer
     */
    public function toEntity(array $data): EntityInterface
    {
        $orders = new OrderCollection($data['orders'] ?? []);
        $productReviews = new ProductReviewCollection($data['product_reviews'] ?? []);
        $favorites = new CustomerFavoriteProductCollection($data['favorites'] ?? []);
        $quotes = new QuoteCollection($data['quotes'] ?? []);
        $customFields = new CustomerCustomFieldCollection($data['custom_fields'] ?? []);

        return (new Customer)
            ->setCustomerId($data['customer_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at'] ?? null))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setCustomerRef($data['customer_ref'] ?? null)
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
            ->setQuotes($quotes)
            ->setCustomFields($customFields);
    }
}
