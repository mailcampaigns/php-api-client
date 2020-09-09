<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\OrderCustomField;

class OrderCustomFieldCollection extends AbstractCollection
{
    const ENTITY_CLASS = OrderCustomField::class;

    /**
     * {@inheritDoc}
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $arr = [];

        foreach ($this->elements as $element) {
            if ($element instanceof OrderCustomField) {
                $arr[$element->getName()] = $element->getValue();
            } else {
                $arr[] = $element;
            }
        }

        return $arr;
    }
}
