<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\Subscriber;

class SubscriberCollection extends AbstractCollection
{
    public static $entityFqcn = Subscriber::class;
}
