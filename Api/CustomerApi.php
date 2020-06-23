<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;

class CustomerApi extends AbstractApi
{
    /**
     * @param int $id
     * @return Customer
     */
    public function getSingle(int $id): EntityInterface
    {
        return $this->toEntity($this->get("customers/{$id}"));
    }

    /**
     * @return CustomerCollection
     */
    public function getCollection(): CollectionInterface
    {
        $collection = new CustomerCollection;

        $parameters = [
            'page' => $this->page,
            'itemsPerPage' => $this->perPage
        ];

        $data = $this->get('customers', $parameters);

        foreach ($data['hydra:member'] as $customerData) {
            $customer = $this->toEntity($customerData);
            $collection->append($customer);
        }

        return $collection;
    }

    /**
     * @param array $data
     * @return Customer
     */
    public function toEntity(array $data): EntityInterface
    {
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
            // todo: add setters for addresses
            ->setLanguage($data['language'])
            ->setOrders($data['orders'])
            ->setProductReviews($data['product_reviews'])
            ->setFavorites($data['favorites'])
            ->setQuotes($data['quotes']);
    }
}
