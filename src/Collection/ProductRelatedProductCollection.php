<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductRelatedProduct;

class ProductRelatedProductCollection extends AbstractCollection
{
    const ENTITY_CLASS = ProductRelatedProduct::class;

    public function __construct(array $elements = [])
    {
        parent::__construct($elements);

        // When updating (a product), this collection's elements should be sent as
        // arrays, the default (IRI) won't work.
        $this->toArrayTypeMapping['PUT'] = 'array';
    }
}
