<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Exception;

class ApiLimitExceededException extends ApiException
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $reset;

    public function __construct($limit = 5000, $reset = 1800, $code = 0, $previous = null)
    {
        $this->limit = (int)$limit;
        $this->reset = (int)$reset;

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
