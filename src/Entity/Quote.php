<?php

namespace MailCampaigns\ApiClient\Entity;

class Quote implements EntityInterface
{
    /**
     * @inheritDoc
     */
    function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [
        ];
    }

    /**
     * @inheritDoc
     */
    function toIri(): string
    {
        // todo: finish
        return '/quotes/' . 0;//$this->getQuoteId();
    }
}
