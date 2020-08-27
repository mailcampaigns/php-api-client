<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\CustomerFavoriteProduct;

class CustomerFavoriteProductCollection extends AbstractCollection
{
    const ENTITY_CLASS = CustomerFavoriteProduct::class;

    public function __construct(array $elements = [])
    {
        parent::__construct($elements);

        // When updating (a customer), this collection's elements should be sent as
        // arrays, the default (IRI) won't work.
        $this->toArrayTypeMapping['PUT'] = 'array';
    }
}
