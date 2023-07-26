<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Order;

class OrderCollection extends AbstractCollection
{
    public static string $entityFqcn = Order::class;
}
