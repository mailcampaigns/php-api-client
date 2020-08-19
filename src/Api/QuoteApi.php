<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\QuoteCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Quote;

class QuoteApi extends AbstractApi
{
    /**
     * @param EntityInterface|Quote $entity
     * @return Quote
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof Quote) {
            throw new InvalidArgumentException('Expected quote entity!');
        }

        // Send request.
        $res = $this->post('quotes', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return Quote
     */
    public function getById(int $id): EntityInterface
    {
        return $this->toEntity($this->get("quotes/{$id}"));
    }

    /**
     * @param string $ref
     * @return Quote|null
     */
    public function getByQuoteRef(string $ref): ?Quote
    {
        $data = $this->handleSingleItemResponse(
            $this->get("quotes", ['quote_ref' => $ref])
        );

        if (null !== $data) {
            return $this->toEntity($data);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     * @return QuoteCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $collection = new QuoteCollection;

        $data = $this->get('quotes', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        foreach ($data['hydra:member'] as $quoteData) {
            $quote = $this->toEntity($quoteData);
            $collection->add($quote);
        }

        return $collection;
    }

    /**
     * Updates a quote.
     *
     * @param EntityInterface $entity
     * @return Quote
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof Quote) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                Quote::class));
        }

        $res = $this->put("quotes/{$entity->getQuoteId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes a quote by id.
     *
     * @param int $id
     * @return $this
     */
    public function deleteById(int $id): ApiInterface
    {
        $this->delete("quotes/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     * @return Quote
     */
    function toEntity(array $data): EntityInterface
    {
        $customer = null;

        if (isset($data['customer']) && is_string($data['customer'])) {
            if (false !== preg_match('/\/customers\/(\d+)/', $data['customer'], $matches)) {
                if (isset($matches[1])) {
                    $customerId = (int)$matches[1];
                    $customer = (new Customer)->setCustomerId($customerId);
                }
            }
        }

        return (new Quote)
            ->setQuoteId($data['quote_id'])
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setQuoteRef($data['quote_ref'])
            ->setQuantity($data['quantity'])
            ->setPriceCost($data['price_cost'])
            ->setPriceExcl($data['price_excl'])
            ->setPriceIncl($data['price_incl'])
            ->setShipmentPriceExcl($data['shipment_price_excl'])
            ->setShipmentPriceIncl($data['shipment_price_incl'])
            ->setDiscountExcl($data['discount_excl'])
            ->setDiscountincl($data['discount_incl'])
            ->setProductsCount($data['products_count'])
            ->setProductsQuantity($data['products_quantity'])
            ->setDiscountRef($data['discount_ref'])
            ->setDiscountType($data['discount_type'])
            ->setDiscountAmount($data['discount_amount'])
            ->setDiscountPercentage($data['discount_percentage'])
            ->setDiscountShipment($data['discount_shipment'])
            ->setDiscountMinimumAmount($data['discount_minimum_amount'])
            ->setDiscountCouponCode($data['discount_coupon_code'])
            ->setCustomerRef($data['customer_ref'])
            ->setCustomer($customer)
            ->setQuoteProducts($data['quote_products'])
            ->setOrders($data['orders']);
    }
}
