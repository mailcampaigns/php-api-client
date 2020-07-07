<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductVolumeSellProduct;

class ProductVolumeSellProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductVolumeSellProduct $volumeSellProduct */
        foreach ($this->getIterator() as $volumeSellProduct) {
            $iris[] = $volumeSellProduct instanceof ProductVolumeSellProduct ? $volumeSellProduct->toIri() : $volumeSellProduct;
        }

        return $iris;
    }
}
