<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Customer;

class CustomerCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var Customer $customer */
        foreach ($this->getIterator() as $customer) {
            $iris[] = $customer instanceof Customer ? $customer->toIri() : $customer;
        }

        return $iris;
    }
}
