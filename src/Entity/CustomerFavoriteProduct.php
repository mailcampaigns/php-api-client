<?php

namespace MailCampaigns\ApiClient\Entity;

class CustomerFavoriteProduct implements EntityInterface
{

    /**
     * @inheritDoc
     */
    function toArray(): array
    {
        // todo: implement
        return [
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        // todo: finish
        return '/customer_favorite_products/' . $this->getCustomer()->getIri();
    }
}
