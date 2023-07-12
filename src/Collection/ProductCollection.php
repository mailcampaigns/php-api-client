<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Product;

class ProductCollection extends AbstractCollection
{
    public static $entityFqcn = Product::class;
}
