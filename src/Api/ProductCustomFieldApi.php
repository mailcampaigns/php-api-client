<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\ProductCustomFieldCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\ProductCustomField;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class ProductCustomFieldApi extends AbstractApi
{
    /**
     * @param EntityInterface|ProductCustomField $entity
     * @return ProductCustomField
     * @throws HttpClientExceptionInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof ProductCustomField) {
            throw new InvalidArgumentException('Expected custom product field entity!');
        }

        // Send request.
        $res = $this->post('product_custom_fields', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return ProductCustomField
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("product_custom_fields/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return ProductCustomFieldCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('product_custom_fields', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, ProductCustomFieldCollection::class);
    }

    /**
     * Updates a custom product field.
     *
     * @param EntityInterface $entity
     * @return ProductCustomField
     * @throws HttpClientExceptionInterface
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof ProductCustomField) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                ProductCustomField::class));
        }

        $res = $this->put("product_custom_fields/{$entity->getCustomFieldId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes a custom product field by id.
     *
     * @param int $id
     * @return $this
     * @throws HttpClientExceptionInterface
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("product_custom_fields/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(array $data): EntityInterface
    {
        $customField = (new ProductCustomField)
            ->setCustomFieldId($data['custom_field_id'] ?? null)
            ->setCreatedAt($this->toDtObject($data['created_at']))
            ->setUpdatedAt($this->toDtObject($data['updated_at']))
            ->setName($data['name'])
            ->setValue($data['value']);

        // Set linked product.
        if (isset($data['product']) && is_string($data['product'])) {
            if (false !== preg_match('/\/products\/(\d+)/', $data['product'], $matches)) {
                if (isset($matches[1])) {
                    $product = (new Product)->setProductId((int)$matches[1]);
                    $customField->setProduct($product);
                }
            }
        }

        return $customField;
    }
}
