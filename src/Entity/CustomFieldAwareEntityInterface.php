<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

interface CustomFieldAwareEntityInterface
{
    function getNewCustomField(): CustomFieldInterface;
    function addCustomField(CustomFieldInterface $customField): self;
    function removeCustomField(CustomFieldInterface $customField): self;
}
