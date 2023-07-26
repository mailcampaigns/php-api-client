<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\OrderProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Order;
use MailCampaigns\ApiClient\Entity\OrderProduct;
use MailCampaigns\ApiClient\Entity\Product;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class OrderProductApi extends AbstractApi
{
    public function create(OrderProduct|EntityInterface $entity): OrderProduct
    {
        assert($entity instanceof OrderProduct);
        return $this->toEntity($this->post('order_products', $entity));
    }

    public function getById($id): OrderProduct
    {
        return $this->toEntity($this->get("order_products/$id"));
    }

    /**
     * @throws HttpClientExceptionInterface
     */
    public function getByOrderId(int|string $id): OrderProductCollection
    {
        assert(is_numeric($id));

        $data = $this->get("orders/$id/order_products");
        $collection = $this->toCollection($data, OrderProductCollection::class);
        assert($collection instanceof OrderProductCollection);

        return $collection;
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): OrderProductCollection {
        $data = $this->get('order_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, OrderProductCollection::class);
        assert($collection instanceof OrderProductCollection);

        return $collection;
    }

    public function update(OrderProduct|EntityInterface $entity): OrderProduct
    {
        assert($entity instanceof OrderProduct);

        return $this->toEntity(
            $this->put("order_products/{$entity->getOrderProductId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("order_products/$id");
        return $this;
    }

    public function toEntity(array $data): OrderProduct
    {
        $orderProduct = (new OrderProduct())
            ->setOrderProductId($data['order_product_id'])
            ->setSupplierTitle($data['supplier_title'])
            ->setBrandTitle($data['brand_title'])
            ->setProductTitle($data['product_title'])
            ->setTaxRate($data['tax_rate'])
            ->setQuantityOrdered($data['quantity_ordered'])
            ->setQuantityInvoiced($data['quantity_invoiced'])
            ->setQuantityShipped($data['quantity_shipped'])
            ->setQuantityRefunded($data['quantity_refunded'])
            ->setQuantityReturned($data['quantity_returned'])
            ->setArticleCode($data['article_code'])
            ->setEan($data['ean'])
            ->setSku($data['sku'])
            ->setQuantity($data['quantity'])
            ->setPriceCost($data['price_cost'])
            ->setBasePriceExcl($data['base_price_excl'])
            ->setBasePriceIncl($data['base_price_incl'])
            ->setPriceExcl($data['price_excl'])
            ->setPriceIncl($data['price_incl'])
            ->setDiscountExcl($data['discount_excl'])
            ->setDiscountIncl($data['discount_incl']);

        // Set linked order.
        if (isset($data['order']) && is_string($data['order'])) {
            if (false !== preg_match('/\/orders\/(\d+)/', $data['order'], $matches)) {
                if (isset($matches[1])) {
                    $orderId = (int)$matches[1];

                    $orderProduct->setOrder(
                        (new Order())
                            ->setOrderId($orderId)
                            ->addOrderProduct($orderProduct)
                    );
                }
            }
        }

        // Set linked product.
        if (isset($data['product']) && is_string($data['product'])) {
            if (false !== preg_match('/\/products\/(\d+)/', $data['product'], $matches)) {
                if (isset($matches[1])) {
                    $product = (new Product())->setProductId((int)$matches[1]);
                    $orderProduct->setProduct($product);
                }
            }
        }

        return $orderProduct;
    }
}
