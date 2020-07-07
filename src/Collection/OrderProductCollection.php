<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\OrderProduct;

class OrderProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var OrderProduct $orderProduct */
        foreach ($this->getIterator() as $orderProduct) {
            $iris[] = $orderProduct instanceof OrderProduct ? $orderProduct->toIri() : $orderProduct;
        }

        return $iris;
    }
}
