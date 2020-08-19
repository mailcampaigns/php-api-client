<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Order;
use MailCampaigns\ApiClient\Entity\Quote;

/**
 * @link https://docs.mailcampaigns.io/?version=latest#486611d7-bb98-4e95-8e08-564cdbed6b7f
 */
class OrderApi extends AbstractApi
{
    /**
     * {@inheritDoc}
     * @param Order|EntityInterface $entity
     * @return Order
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->validateEntityType($entity, Order::class);
        $res = $this->post('orders', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return Order
     */
    public function getById(int $id): EntityInterface
    {
        return $this->toEntity($this->get("orders/{$id}"));
    }

    /**
     * Tries to find a order by number, returns null when no order was found with
     * the given order number.
     *
     * @param string $number
     * @return Order|null
     */
    public function getByNumber(string $number): ?EntityInterface
    {
        $data = $this->handleSingleItemResponse(
            $this->get('orders', ['number' => $number])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        // Order was not found.
        return null;
    }

    /**
     * {@inheritDoc}
     * @return OrderCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new OrderCollection;

        $data = $this->get('orders', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        foreach ($data['hydra:member'] as $orderData) {
            $order = $this->toEntity($orderData);
            $collection->add($order);
        }

        return $collection;
    }

    /**
     * Updates an order.
     *
     * @param EntityInterface $entity
     * @return Order
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof Order) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                Order::class));
        }

        $res = $this->put("orders/{$entity->getOrderId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes an order by id.
     *
     * @param int $id
     * @return $this
     */
    public function deleteById(int $id): ApiInterface
    {
        $this->delete("orders/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    function toEntity(array $data): EntityInterface
    {
        $customer = $quote = null;

        // Convert customer IRI to an entity.
        if (isset($data['customer']) && is_string($data['customer'])) {
            if (false !== preg_match('/\/customers\/(\d+)/', $data['customer'], $matches)) {
                if (isset($matches[1])) {
                    $customerId = (int)$matches[1];
                    $customer = (new Customer)->setCustomerId($customerId);
                }
            }
        }

        // Convert quote IRI to an entity.
        if (isset($data['quote']) && is_string($data['quote'])) {
            if (false !== preg_match('/\/quotes\/(\d+)/', $data['quote'], $matches)) {
                if (isset($matches[1])) {
                    $quoteId = (int)$matches[1];
                    $quote = (new Quote)->setQuoteId($quoteId);
                }
            }
        }

        return (new Order)
            ->setOrderId($data['order_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setNumber($data['number'])
            ->setStatus($data['status'])
            ->setPriceCost($data['price_cost'])
            ->setPriceExcl($data['price_excl'])
            ->setPriceIncl($data['price_incl'])
            ->setShipmentPriceExcl($data['shipment_price_excl'])
            ->setShipmentPriceIncl($data['shipment_price_incl'])
            ->setWeight($data['weight'])
            ->setVolume($data['volume'])
            ->setGender($data['gender'])
            ->setBirthDate($this->toDtObject($data['birth_date']))
            ->setEmail($data['email'])
            ->setFirstName($data['first_name'])
            ->setMiddleName($data['middle_name'])
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
            ->setAddressShippingName($data['address_shipping_name'])
            ->setAddressShippingStreet($data['address_shipping_street'])
            ->setAddressShippingNumber($data['address_shipping_number'])
            ->setAddressShippingExtension($data['address_shipping_extension'])
            ->setAddressShippingZipcode($data['address_shipping_zipcode'])
            ->setAddressShippingCity($data['address_shipping_city'])
            ->setAddressShippingRegion($data['address_shipping_region'])
            ->setAddressShippingCountry($data['address_shipping_country'])
            ->setIsDiscounted($data['is_discounted'])
            ->setDiscountType($data['discount_type'])
            ->setDiscountAmount($data['discount_amount'])
            ->setDiscountPercentage($data['discount_percentage'])
            ->setDiscountCouponCode($data['discount_coupon_code'])
            ->setLanguage($data['language'])
            ->setCustomerRef($data['customer_ref'])
            ->setCustomer($customer)
            ->setOrderProducts($data['order_products'])
            ->setQuote($quote);
    }
}
