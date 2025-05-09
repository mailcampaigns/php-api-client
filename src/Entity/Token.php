<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class Token
{
    /** @var string[] Supported scopes by the API. */
    public const VALID_SCOPES = ['read', 'write'];

    /** @var int A buffer time in seconds to consider a token to be expired. */
    public const EXPIRATION_BUFFER_SECS = 10;

    public function __construct(
        public string $accessToken,
        public int $createdAt,
        public int $expiresIn,
    ) {
    }

    /**
     * Returns true if token has expired.
     */
    public function hasExpired(): bool
    {
        return $this->createdAt + $this->expiresIn - time() <= self::EXPIRATION_BUFFER_SECS;
    }
}
