<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

/**
 * Interface for entities implementing custom fields. Use in combination
 * with CustomFieldTrait.
 */
interface CustomFieldInterface extends EntityInterface
{
    function getCustomFieldId(): ?int;

    function setCustomFieldId(int $customFieldId): self;

    function getName(): ?string;

    function setName(?string $name): self;

    function getValue(): ?string;

    function setValue(?string $value): self;
}
