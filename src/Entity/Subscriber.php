<?php

namespace MailCampaigns\ApiClient\Entity;

class Subscriber implements EntityInterface
{
    use DateTimeHelperTrait;

    /**
     * @var int
     */
    protected $subscriberId;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var bool
     */
    protected $isSubscribed;

    /**
     * @var bool
     */
    protected $isConfirmed;

    /**
     * @return int
     */
    public function getSubscriberId(): ?int
    {
        return $this->subscriberId;
    }

    /**
     * @param int|null $subscriberId
     * @return $this
     */
    public function setSubscriberId(?int $subscriberId): self
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return $this
     */
    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSubscribed(): ?bool
    {
        return $this->isSubscribed;
    }

    /**
     * @param bool|null $isSubscribed
     * @return $this
     */
    public function setIsSubscribed(?bool $isSubscribed): self
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param bool|null $isConfirmed
     * @return $this
     */
    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'subscriber_id' => $this->getSubscriberId(),
            'email_address' => $this->getEmailAddress(),
            'is_subscribed' => $this->isSubscribed(),
            'is_confirmed' => $this->isConfirmed(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        if (null === $this->getSubscriberId()) {
            return null;
        }

        return '/subscribers/' . $this->getSubscriberId();
    }
}
