<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductUpSellProduct;

class ProductUpSellProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductUpSellProduct $upSellProduct */
        foreach ($this->getIterator() as $upSellProduct) {
            $iris[] = $upSellProduct instanceof ProductUpSellProduct ? $upSellProduct->toIri() : $upSellProduct;
        }

        return $iris;
    }
}
