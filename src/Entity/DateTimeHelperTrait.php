<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

trait DateTimeHelperTrait
{
    /**
     * Converts a datetime object to a string.
     *
     * @param DateTime|null $dt
     * @return string|null
     */
    protected function dtToString(?DateTime $dt): ?string
    {
        // Return null when no datetime object was given.
        if (!$dt instanceof DateTime) {
            return null;
        }

        return $dt->format(DateTime::ISO8601);
    }
}
