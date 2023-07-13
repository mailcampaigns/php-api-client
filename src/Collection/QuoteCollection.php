<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Quote;

class QuoteCollection extends AbstractCollection
{
    public static string $entityFqcn = Quote::class;
}
