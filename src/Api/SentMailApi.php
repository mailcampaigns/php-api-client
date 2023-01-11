<?php

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\SentMailCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\SentMail;
use MailCampaigns\ApiClient\Exception\ApiException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class SentMailApi extends AbstractApi
{
    /**
     * @throws HttpClientExceptionInterface
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
     * {@inheritDoc}
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * {@inheritDoc}
     * @return SentMail
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("sent_mails/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return SentMailCollection
     */
    public function getCollection(
        ?int $page = null,
        ?int $perPage = null,
        ?array $order = null,
        ?array $filters = null
    ): CollectionInterface {
        $params = [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE,
        ];

        if ($filters !== null) {
            foreach ($filters as $key => $value) {
                $params[$key] = $value;
            }
        }

        $data = $this->get('sent_mails', $params);

        return $this->toCollection($data, SentMailCollection::class);
    }

    /**
     * {@inheritDoc}
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id): ApiInterface
    {
        throw new ApiException('Operation not supported!');
    }

    /**
     * @inheritDoc
     * @return SentMail
     */
    public function toEntity(array $data): EntityInterface
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
