<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

/**
 * Interface for entities implementing custom fields. Use in combination
 * with CustomFieldTrait.
 */
interface CustomFieldInterface extends EntityInterface
{
    public function getCustomFieldId(): ?int;

    public function setCustomFieldId(int $customFieldId): self;

    public function getName(): ?string;

    public function setName(?string $name): self;

    public function getValue(): ?string;

    public function setValue(?string $value): self;
}
