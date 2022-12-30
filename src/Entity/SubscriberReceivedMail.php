<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

class SubscriberReceivedMail implements EntityInterface
{
    use DateTimeHelperTrait;

    /**
     * @var int
     */
    private $subscriberReceivedMailId;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $url;

    /**
     * @var DateTime
     */
    private $receivedAt;

    public function __construct(int $subscriberReceivedMailId, string $subject, string $url, DateTime $receivedAt)
    {
        $this->subscriberReceivedMailId = $subscriberReceivedMailId;
        $this->subject = $subject;
        $this->url = $url;
        $this->receivedAt = $receivedAt;
    }

    public function getSubscriberReceivedMailId(): int
    {
        return $this->subscriberReceivedMailId;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getReceivedAt(): DateTime
    {
        return $this->receivedAt;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'subscriber_received_mail_id' => $this->getSubscriberReceivedMailId(),
            'subject' => $this->getSubject(),
            'url' => $this->getUrl(),
            'received_at' => $this->dtToString($this->getReceivedAt()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        return '/subscriber_received_mails/' . $this->getSubscriberReceivedMailId();
    }
}
