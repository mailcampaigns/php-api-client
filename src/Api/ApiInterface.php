<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\CustomerCollection;
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
    public function getById(int $id): EntityInterface;

    /**
     * @param int|null $page
     * @param int|null $perPage
     * @return CollectionInterface
     */
    public function getCollection(?int $page, ?int $perPage): CollectionInterface;

    /**
     * @param array $data
     * @return EntityInterface
     */
    function toEntity(array $data): EntityInterface;
}
