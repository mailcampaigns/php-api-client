<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Quote;

class QuoteCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var Quote $quote */
        foreach ($this->getIterator() as $quote) {
            $iris[] = $quote instanceof Quote ? $quote->toIri() : $quote;
        }

        return $iris;
    }
}
