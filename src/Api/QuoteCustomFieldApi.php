<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\QuoteCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Quote;
use MailCampaigns\ApiClient\Entity\QuoteCustomField;

class QuoteCustomFieldApi implements ApiInterface, CustomFieldApiInterface
{
    use ApiTrait;

    public function create(QuoteCustomField|EntityInterface $entity): QuoteCustomField
    {
        assert($entity instanceof QuoteCustomField);
        return $this->toEntity($this->post('quote_custom_fields', $entity));
    }

    public function getById(int|string $id): QuoteCustomField
    {
        return $this->toEntity($this->get("quote_custom_fields/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): QuoteCustomFieldCollection {
        $data = $this->get('quote_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, QuoteCustomFieldCollection::class);
        assert($collection instanceof QuoteCustomFieldCollection);

        return $collection;
    }

    public function update(QuoteCustomField|EntityInterface $entity): QuoteCustomField
    {
        assert($entity instanceof QuoteCustomField);

        return $this->toEntity(
            $this->put("quote_custom_fields/{$entity->getCustomFieldId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("quote_custom_fields/$id");
        return $this;
    }


    public function toEntity(array $data): QuoteCustomField
    {
        $customField = (new QuoteCustomField())
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked quote.
        if (isset($data['quote']) && is_string($data['quote'])) {
            if (false !== preg_match('/\/quotes\/(\d+)/', $data['quote'], $matches)) {
                if (isset($matches[1])) {
                    $quote = (new Quote())->setQuoteId((int)$matches[1]);
                    $customField->setQuote($quote);
                }
            }
        }

        return $customField;
    }
}
