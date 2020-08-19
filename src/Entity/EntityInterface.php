<?php

namespace MailCampaigns\ApiClient\Entity;

interface EntityInterface
{
    const OPERATION_GET = 'GET';
    const OPERATION_PUT = 'PUT';
    const OPERATION_POST = 'POST';
    const OPERATION_PATCH = 'PATCH';
    const OPERATION_DELETE = 'DELETE';

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