<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

trait DateTrait
{
    /**
     * Creation date and time.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Date and time of last update.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
