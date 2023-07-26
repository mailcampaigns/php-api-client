<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductCategory;

class ProductCategoryCollection extends AbstractCollection
{
    public static string $entityFqcn = ProductCategory::class;
}
