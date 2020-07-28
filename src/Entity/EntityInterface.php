<?php

namespace MailCampaigns\ApiClient\Entity;

interface EntityInterface
{
    /**
     * Converts the entity to an array.
     * @return array
     */
    function toArray(): array;

    /**
     * Returns the IRI for this API resource.
     * @return string|null
     */
    function toIri(): ?string;
}
