<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;

interface ApiInterface
{
    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage): self;

    /**
     * @return null|int
     */
    public function getPerPage(): int;

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function getSingle(int $id): EntityInterface;

    /**
     * @return CollectionInterface
     */
    public function getCollection(): CollectionInterface;

    /**
     * @param array $data
     * @return EntityInterface
     */
    function toEntity(array $data): EntityInterface;
}
