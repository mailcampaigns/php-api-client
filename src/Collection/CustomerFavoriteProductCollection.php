<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\CustomerFavoriteProduct;

class CustomerFavoriteProductCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var CustomerFavoriteProduct $favoriteProduct */
        foreach ($this->getIterator() as $favoriteProduct) {
            $iris[] = $favoriteProduct instanceof CustomerFavoriteProduct
                ? $favoriteProduct->toIri() : $favoriteProduct;
        }

        return $iris;
    }
}
