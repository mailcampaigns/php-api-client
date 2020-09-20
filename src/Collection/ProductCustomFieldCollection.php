<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\Entity\ProductCustomField;

class ProductCustomFieldCollection extends AbstractCollection
{
    const ENTITY_CLASS = ProductCustomField::class;

    /**
     * {@inheritDoc}
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $arr = [];

        foreach ($this->elements as $element) {
            if ($element instanceof ProductCustomField) {
                if ($operation === ApiInterface::OPERATION_POST) {
                    $arr[] = $element->toArray($operation);
                } else {
                    $arr[$element->getName()] = $element->getValue();
                }
            } else {
                $arr[] = $element;
            }
        }

        return $arr;
    }
}
