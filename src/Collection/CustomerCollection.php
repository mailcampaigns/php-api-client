<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Customer;

class CustomerCollection extends AbstractCollection
{
    public static string $entityFqcn = Customer::class;
}
