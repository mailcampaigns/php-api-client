<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\QuoteCollection;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Quote;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class QuoteApi extends AbstractApi
{
    public const ORDERABLE_PARAMS = [
        'quote_id',
        'created_at',
        'updated_at'
    ];

    public const DEFAULT_ORDER = [
        'created_at' => 'desc'
    ];

    public function create(Quote|EntityInterface $entity): Quote
    {
        assert($entity instanceof Quote);
        return $this->toEntity($this->post('quotes', $entity));
    }

    public function getById(int|string $id): Quote
    {
        return $this->toEntity($this->get("quotes/$id"));
    }

    /**
     * @throws HttpClientExceptionInterface
     */
    public function getByQuoteRef(string $ref): ?Quote
    {
        $data = $this->handleSingleItemResponse(
            $this->get("quotes", ['quote_ref' => $ref])
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    /**
     * Finds and returns quotes by their `quote_ref` values.
     *
     * @param string[] $refs
     * @throws HttpClientExceptionInterface
     */
    public function getByQuoteRefs(
        array $refs,
        ?int $page = null,
        ?int $perPage = null
    ): QuoteCollection {
        $data = $this->get('quotes', [
            'quote_ref' => $refs,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, QuoteCollection::class);
        assert($collection instanceof QuoteCollection);

        return $collection;
    }

    /**
     * Tries to find a quote by customer reference, returns null when not found.
     * @throws HttpClientExceptionInterface
     */
    public function getByCustomerRef(string $ref): ?Quote
    {
        $data = $this->handleSingleItemResponse(
            $this->get('quotes', ['customer_ref' => $ref])
        );

        return null !== $data ? $this->toEntity($data) : null;
    }

    /**
     * @throws HttpClientExceptionInterface
     */
    public function getByCustomerRefs(
        array $refs,
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null
    ): QuoteCollection {
        $data = $this->get('quotes', [
            'customer_ref' => $refs,
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
            'order' => $order ?? self::DEFAULT_ORDER
        ]);

        $collection = $this->toCollection($data, QuoteCollection::class);
        assert($collection instanceof QuoteCollection);

        return $collection;
    }

    /**
     * {@inheritDoc}
     * @param array $filters Optional filters.
     */
    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        $filters = []
    ): QuoteCollection {
        $params = [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ];

        if (count($filters) > 0) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $collection = $this->toCollection(
            $this->get('quotes', $params),
            QuoteCollection::class
        );

        assert($collection instanceof QuoteCollection);

        return $collection;
    }

    public function update(Quote|EntityInterface $entity): Quote
    {
        assert($entity instanceof Quote);

        return $this->toEntity(
            $this->put("quotes/{$entity->getQuoteId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("quotes/$id");
        return $this;
    }

    public function toEntity(array $data): Quote
    {
        $customer = null;

        if (isset($data['customer']) && is_string($data['customer'])) {
            if (false !== preg_match('/\/customers\/(\d+)/', $data['customer'], $matches)) {
                if (isset($matches[1])) {
                    $customerId = (int)$matches[1];
                    $customer = (new Customer())->setCustomerId($customerId);
                }
            }
        }

        return (new Quote())
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
