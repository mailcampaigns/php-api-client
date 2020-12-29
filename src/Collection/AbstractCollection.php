<?php

namespace MailCampaigns\ApiClient\Collection;

use ArrayIterator;
use LogicException;
use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;

abstract class AbstractCollection implements CollectionInterface
{
    /**
     * FQCN of the entities this collection holds.
     */
    public static $entityFqcn;

    /**
     * An array containing the entries of this collection.
     *
     * @var array
     */
    protected $elements;

    /**
     * @var array
     */
    protected $toArrayTypeMapping;

    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        /** @var AbstractCollection $calledClass */
        $calledClass = get_called_class();

        // Check if the implementation of this abstract collection has correctly
        // set the entity's fqcn.
        if (!$calledClass::$entityFqcn) {
            throw new LogicException(sprintf('The entity class fqcn is not set for this '
                . 'collection (`%s`)! Note: Entities should implement the entity interface.', $calledClass));
        }

        $this->elements = $elements;

        // Set the default mapping for 'hydration' of a collection.
        $this->toArrayTypeMapping = [
            ApiInterface::OPERATION_GET => 'array',
            ApiInterface::OPERATION_PUT => 'iri',
            ApiInterface::OPERATION_POST => 'array',
            ApiInterface::OPERATION_PATCH => 'array'
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class . '@' . spl_object_hash($this);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        $arr = [];
        $operation = $operation ?? ApiInterface::OPERATION_GET;
        $toType = $this->toArrayTypeMapping[$operation] ?? null;

        /** @var EntityInterface $element */
        foreach ($this->elements as $element) {
            if ($element instanceof EntityInterface) {
                switch ($toType) {
                    case 'iri':
                        $arr[] = $element->toIri();
                        break;
                    case 'array':
                        $arr[] = $element->toArray($operation, $isRoot);
                        break;
                    default:
                        throw new LogicException('Invalid or missing type mapping!');
                }
            } else {
                $arr[] = $element;
            }
        }

        return $arr;
    }

    /**
     * {@inheritDoc}
     */
    public function add($element): CollectionInterface
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }

    /**
     * {@inheritDoc}
     */
    public function containsKey($key): bool
    {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function remove($key)
    {
        if (!isset($this->elements[$key]) && !array_key_exists($key, $this->elements)) {
            return null;
        }

        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    /**
     * @inheritDoc
     */
    public function removeElement($element): bool
    {
        $key = array_search($element, $this->elements, true);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return $this->containsKey($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->add($value);

            return;
        }

        $this->set($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value): void
    {
        $this->elements[$key] = $value;
    }
}
