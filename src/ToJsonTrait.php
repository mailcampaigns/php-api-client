<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient;

trait ToJsonTrait
{
    public function toJson(
        bool $pretty = false,
        ?string $operation = null,
        ?bool $isRoot = null
    ): string {
        $res = json_encode(
            $this->toArray($operation, $isRoot),
            ($pretty ? JSON_PRETTY_PRINT : 0) | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        );

        if (false === $res) {
            // We always want to return a string, even when the encoding fails.
            $res = '"false"';
        }

        return $res;
    }
}
