<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\Entity\OrderCustomField;

class OrderCustomFieldCollection extends AbstractCollection
{
    public static string $entityFqcn = OrderCustomField::class;

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        $arr = [];

        foreach ($this->elements as $element) {
            if ($element instanceof OrderCustomField) {
                if ($operation === ApiInterface::OPERATION_POST) {
                    $arr[] = $element->toArray($operation);
                } elseif ($operation === ApiInterface::OPERATION_PUT) {
                    if ($element->getCustomFieldId()) {
                        $arr[] = $element->toIri();
                    }
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
