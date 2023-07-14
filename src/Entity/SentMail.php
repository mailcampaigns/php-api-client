<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTimeInterface;

class SentMail implements EntityInterface
{
    use DateTimeHelperTrait;

    public function __construct(
        private readonly int $sentMailId,
        private readonly string $toEmailAddress,
        private readonly string $subject,
        private readonly string $url,
        private DateTimeInterface $sentAt,
    ) {
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

    public function getSentAt(): DateTimeInterface
    {
        return $this->sentAt;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'sent_mail_id' => $this->getSentMailId(),
            'to_email_address' => $this->getToEmailAddress(),
            'subject' => $this->getSubject(),
            'url' => $this->getUrl(),
            'sent_at' => $this->dtToString($this->getSentAt()),
        ];
    }

    public function toIri(): ?string
    {
        return '/sent_mails/' . $this->getSentMailId();
    }

    public function __destruct()
    {
        unset($this->sentAt);
    }
}
