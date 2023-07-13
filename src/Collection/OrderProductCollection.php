<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\OrderProduct;

class OrderProductCollection extends AbstractCollection
{
    public static string $entityFqcn = OrderProduct::class;
}
