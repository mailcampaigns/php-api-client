<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\SentMail;

class SentMailCollection extends AbstractCollection
{
    public static string $entityFqcn = SentMail::class;
}
