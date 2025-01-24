<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\ToJsonInterface;

interface EntityInterface extends ToJsonInterface
{
    /**
     * Converts the entity to an array.
     *
     * Supply the operation name (use one of the OPERATION_* constants defined in
     * this class) to hydrate this entity for. Defaults to OPERATION_GET.
     * @todo: move to ToArrayTrait? (also in collections)
     */
    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array;

    /**
     * Returns the IRI for this API resource, will return null in case id is not
     * set.
     */
    public function toIri(): ?string;
}
