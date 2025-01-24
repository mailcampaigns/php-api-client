<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use MailCampaigns\ApiClient\ToJsonTrait;

class QuoteCustomField implements CustomFieldInterface
{
    use CustomFieldTrait;
    use ToJsonTrait;

    private ?Quote $quote = null;

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): self
    {
        $this->quote = $quote;
        return $this;
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'custom_field_id' => $this->getCustomFieldId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'quote' => $this->getQuote()->toIri()
        ];
    }

    public function toIri(): ?string
    {
        return '/quote_custom_fields/' . $this->customFieldId;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->quote);
    }
}
