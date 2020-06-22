<?php

namespace MailCampaigns\ApiClient;

class CustomerApi extends AbstractApi
{
    public function getCustomer(int $customerId)
    {
        return $this->get("customers/{$customerId}");
    }

    public function getCustomers()
    {
        $collection = new Collection([
            'customer1',
            'customer2'
        ]);

        return $collection;
    }
}
