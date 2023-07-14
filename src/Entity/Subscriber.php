<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

class Subscriber implements EntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    public function __construct(
        private ?int $subscriberId = null,
        private ?string $emailAddress = null,
        private ?bool $isSubscribed = null,
        private ?bool $isConfirmed = null,
        private ?array $data = [],
    ) {
        $this->createdAt = new DateTime();
    }

    public function getSubscriberId(): ?int
    {
        return $this->subscriberId;
    }

    public function setSubscriberId(?int $subscriberId): self
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function isSubscribed(): ?bool
    {
        return $this->isSubscribed;
    }

    public function setIsSubscribed(?bool $isSubscribed): self
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    public function isConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'subscriber_id' => $this->getSubscriberId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'email_address' => $this->getEmailAddress(),
            'is_subscribed' => $this->isSubscribed(),
            'is_confirmed' => $this->isConfirmed(),
            'data' => $this->getData(),
        ];
    }

    public function toIri(): ?string
    {
        if (null === $this->getSubscriberId()) {
            return null;
        }

        return '/subscribers/' . $this->getSubscriberId();
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
    }
}
