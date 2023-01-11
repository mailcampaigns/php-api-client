<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

class SentMail implements EntityInterface
{
    use DateTimeHelperTrait;

    /**
     * @var int
     */
    private $sentMailId;

    /**
     * @var string
     */
    private $toEmailAddress;

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
    private $sentAt;

    public function __construct(
        int $sentMailId,
        string $toEmailAddress,
        string $subject,
        string $url,
        DateTime $sentAt
    ) {
        $this->sentMailId = $sentMailId;
        $this->toEmailAddress = $toEmailAddress;
        $this->subject = $subject;
        $this->url = $url;
        $this->sentAt = $sentAt;
    }

    public function getSentMailId(): int
    {
        return $this->sentMailId;
    }

    public function getToEmailAddress(): string
    {
        return $this->toEmailAddress;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getSentAt(): DateTime
    {
        return $this->sentAt;
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'sent_mail_id' => $this->getSentMailId(),
            'to_email_address' => $this->getToEmailAddress(),
            'subject' => $this->getSubject(),
            'url' => $this->getUrl(),
            'sent_at' => $this->dtToString($this->getSentAt()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        return '/sent_mails/' . $this->getSentMailId();
    }
}
