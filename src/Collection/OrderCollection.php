<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Order;

class OrderCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var Order $order */
        foreach ($this->getIterator() as $order) {
            $iris[] = $order instanceof Order ? $order->toIri() : $order;
        }

        return $iris;
    }
}
