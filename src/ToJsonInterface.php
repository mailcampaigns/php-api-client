<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

interface ToJsonInterface
{
    /**
     * Returns Json encoded collection data.
     *
     * Please note: On errors, this method will (by design) _not_ throw
     * exceptions or return false but rather return the JSON string "false".
     */
    public function toJson(
        bool $pretty = false,
        ?string $operation = null,
        ?bool $isRoot = null
    ): string;
}
