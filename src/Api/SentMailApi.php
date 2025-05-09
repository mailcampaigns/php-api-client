<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\ApiClientException;
use MailCampaigns\ApiClient\Collection\SentMailCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\SentMail;

class SentMailApi implements ApiInterface
{
    use ApiTrait;

    /**
     * @throws ApiClientException
     */
    public function count(?array $filters = null): int
    {
        $params = [
            'page' => 1,
            'itemsPerPage' => 1,
        ];

        if ($filters !== null) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $data = $this->get('sent_mails', $params);

        return $data['hydra:totalItems'] ?? 0;
    }


    /**
     * @throws ApiClientException
     * {@inheritDoc}
     */
    public function create(SentMail|EntityInterface $entity): SentMail
    {
        throw new ApiClientException('Operation not supported!');
    }

    public function getById(int|string $id): SentMail
    {
        return $this->toEntity($this->get("sent_mails/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $filters = null
    ): SentMailCollection {
        $params = [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
        ];

        if ($filters !== null) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $collection = $this->toCollection(
            $this->get('sent_mails', $params),
            SentMailCollection::class
        );

        assert($collection instanceof SentMailCollection);

        return $collection;
    }

    public function update(SentMail|EntityInterface $entity): SentMail
    {
        throw new ApiClientException('Operation not supported!');
    }

    public function deleteById(int|string $id): self
    {
        throw new ApiClientException('Operation not supported!');
    }

    public function toEntity(array $data): SentMail
    {
        return new SentMail(
            $data['sent_mail_id'],
            $data['to_email_address'],
            $data['subject'],
            $data['url'],
            $this->toDtObject($data['sent_at'] ?? null)
        );
    }
}
