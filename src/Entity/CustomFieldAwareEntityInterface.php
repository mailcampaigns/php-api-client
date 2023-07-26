<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

interface CustomFieldAwareEntityInterface
{
    public function getNewCustomField(): CustomFieldInterface;

    public function addCustomField(CustomFieldInterface $customField): self;

    public function removeCustomField(CustomFieldInterface $customField): self;
}
