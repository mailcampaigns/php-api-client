<?php

namespace MailCampaigns\ApiClient\Entity;

interface EntityInterface
{
    /**
     * Converts the entity to an array.
     *
     * Supply the operation name (use one of the OPERATION_* constants defined in
     * this class) to hydrate this entity for. Defaults to OPERATION_GET.
     *
     * @param string|null $operation The operation name.
     * @return array
     */
    function toArray(?string $operation = null): array;

    /**
     * Returns the IRI for this API resource.
     *
     * @return string|null
     */
    function toIri(): ?string;
}
