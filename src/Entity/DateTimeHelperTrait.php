<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTimeInterface;

trait DateTimeHelperTrait
{
    /**
     * Converts a datetime object to a string.
     */
    protected function dtToString(?DateTimeInterface $dt): ?string
    {
        // Return null when no datetime object was given.
        if (!$dt instanceof DateTimeInterface) {
            return null;
        }

        return $dt->format(DateTimeInterface::ATOM);
    }
}
