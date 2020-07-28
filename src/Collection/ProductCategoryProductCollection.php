<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductCategoryProduct;

class ProductCategoryProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductCategoryProduct $pcp */
        foreach ($this->getIterator() as $pcp) {
            $iris[] = $pcp instanceof ProductCategoryProduct ? $pcp->toIri() : $pcp;
        }

        return $iris;
    }
}
