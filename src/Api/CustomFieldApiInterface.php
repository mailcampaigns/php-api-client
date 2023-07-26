<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Entity\CustomFieldInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;

interface CustomFieldApiInterface extends ApiInterface
{
    public function create(CustomFieldInterface|EntityInterface $entity): CustomFieldInterface;

    public function getById(int|string $id): CustomFieldInterface;

    public function update(CustomFieldInterface|EntityInterface $entity): CustomFieldInterface;

    public function deleteById(int|string $id): CustomFieldApiInterface;

    public function toEntity(array $data): CustomFieldInterface;
}
