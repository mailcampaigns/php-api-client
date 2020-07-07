<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductCategory;

class ProductCategoryCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductCategory $category */
        foreach ($this->getIterator() as $category) {
            $iris[] = $category instanceof ProductCategory ? $category->toIri() : $category;
        }

        return $iris;
    }
}
