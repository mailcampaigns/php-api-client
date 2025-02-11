<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use LogicException;
use MailCampaigns\ApiClient\Collection\OrderCollection;

trait SetOrdersTrait
{
    /**
     * @param iterable|null $orders
     * @return SetOrdersTrait|Customer|Quote
     */
    public function setOrders(?iterable $orders): self
    {
        $this->orders = new OrderCollection();

        if ($orders) {
            foreach ($orders as $data) {
                $order = null;

                if ($data instanceof Order) {
                    $order = $data;
                } else {
                    if (is_string($data)) {
                        // Convert order IRI (string) to an Order entity.
                        $order = $this->iriToOrderEntity($data);
                    } else {
                        throw new LogicException('Order is neither an array nor an IRI!');
                    }
                }

                $this->addOrder($order);
            }
        }

        return $this;
    }
}
