<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;

trait CustomFieldTrait
{
    use DateTrait;
    use DateTimeHelperTrait;

    /**
     * The unique numeric identifier for the custom field.
     *
     * @var int
     */
    protected $customFieldId;

    /**
     * A unique name (key) describing this custom field.
     *
     * @var string
     */
    protected $name;

    /**
     * The value of this custom field.
     *
     * @var string|null
     */
    protected $value;

    public function __construct()
    {
        $this->setCreatedAt(new DateTime);
    }


    public function getCustomFieldId(): ?int
    {
        return $this->customFieldId;
    }


    public function setCustomFieldId(int $customFieldId): self
    {
        $this->customFieldId = $customFieldId;
        return $this;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function getValue(): ?string
    {
        return $this->value;
    }


    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
    }
}