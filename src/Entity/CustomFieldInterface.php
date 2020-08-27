<?php

namespace MailCampaigns\ApiClient\Entity;

/**
 * Interface for entities implementing custom fields. Use in combination
 * with CustomFieldTrait.
 */
interface CustomFieldInterface
{
    /**
     * @return int|null
     */
    function getCustomFieldId(): ?int;

    /**
     * @param int $customFieldId
     * @return $this
     */
    function setCustomFieldId(int $customFieldId);

    /**
     * @return string
     */
    function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    function setName(string $name);

    /**
     * @return string|null
     */
    function getValue(): ?string;

    /**
     * @param string|null $value
     * @return $this
     */
    function setValue(?string $value);
}
