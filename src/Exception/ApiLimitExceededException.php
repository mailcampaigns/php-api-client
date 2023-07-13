<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Exception;

class ApiLimitExceededException extends ApiException
{
    public function __construct(
        private readonly int $limit = 5000,
        private readonly int $reset = 1800,
        $code = 0,
        $previous = null
    ) {
        parent::__construct(sprintf('You have reached MailCampaign\'s hourly limit! Actual limit is: %d', $limit), $code, $previous);
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getResetTime(): int
    {
        return $this->reset;
    }
}
