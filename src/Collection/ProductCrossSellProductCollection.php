<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductCrossSellProduct;

class ProductCrossSellProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductCrossSellProduct $crossSellProduct */
        foreach ($this->getIterator() as $crossSellProduct) {
            $iris[] = $crossSellProduct instanceof ProductCrossSellProduct ? $crossSellProduct->toIri() : $crossSellProduct;
        }

        return $iris;
    }
}
