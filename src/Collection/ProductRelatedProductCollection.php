<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductRelatedProduct;

class ProductRelatedProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductRelatedProduct $relatedProduct */
        foreach ($this->getIterator() as $relatedProduct) {
            $iris[] = $relatedProduct instanceof ProductRelatedProduct ? $relatedProduct->toIri() : $relatedProduct;
        }

        return $iris;
    }
}
