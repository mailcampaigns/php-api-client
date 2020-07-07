<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Product;

class ProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var Product $product */
        foreach ($this->getIterator() as $product) {
            $iris[] = $product instanceof Product ? $product->toIri() : $product;
        }

        return $iris;
    }
}
