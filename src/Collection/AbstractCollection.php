<?php

namespace MailCampaigns\ApiClient\Collection;

use ArrayIterator;
use LogicException;
use MailCampaigns\ApiClient\Entity\EntityInterface;

abstract class AbstractCollection implements CollectionInterface
{
    /**
     * An array containing the entries of this collection.
     *
     * @var array
     */
    private $elements;

    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $calledClass = get_called_class();

        // Check if the implementation of this abstract collection has correctly
        // set the entity class.
        if (!$calledClass::ENTITY_CLASS) {
            throw new LogicException(sprintf('The entity class constant is not set for '
                . 'this collection (`%s`)! Note: It should implement the entity interface.', $calledClass));
        }

        $this->elements = $elements;
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
    public function toArray(?string $operation = null): array
    {
        $arr = [];

        /** @var EntityInterface $element */
        foreach ($this->elements as $element) {
            if ($element instanceof EntityInterface) {
                switch ($operation) {
                    case EntityInterface::OPERATION_PUT:
                        $arr[] = $element->toIri();
                        break;
                    default:
                        $arr[] = $element->toArray($operation);
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
    public function offsetExists($offset)
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
    public function count()
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