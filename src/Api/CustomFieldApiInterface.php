<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Entity\CustomFieldInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;

interface CustomFieldApiInterface extends ApiInterface
{
    /**
     * @param CustomFieldInterface $entity
     * @return CustomFieldInterface
     * {@inheritDoc}
     */
    public function create(EntityInterface $entity): EntityInterface;

    /**
     * @return CustomFieldInterface
     * {@inheritDoc}
     */
    public function getById($id): EntityInterface;

    /**
     * @param CustomFieldInterface $entity
     * @return CustomFieldInterface
     * {@inheritDoc}
     */
    public function update(EntityInterface $entity): EntityInterface;

    /**
     * @return CustomFieldApiInterface
     * @inheritDoc
     */
    public function deleteById($id): ApiInterface;

    /**
     * @return CustomFieldInterface
     * {@inheritDoc}
     */
    public function toEntity(array $data): EntityInterface;
}
