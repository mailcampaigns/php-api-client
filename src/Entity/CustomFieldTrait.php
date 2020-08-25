<?php

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

    /**
     * @inheritDoc
     */
    public function getCustomFieldId(): ?int
    {
        return $this->customFieldId;
    }

    /**
     * @inheritDoc
     */
    public function setCustomFieldId(int $customFieldId): self
    {
        $this->customFieldId = $customFieldId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
    }
}