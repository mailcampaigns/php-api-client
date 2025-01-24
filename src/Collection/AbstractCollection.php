<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use ArrayIterator;
use LogicException;
use MailCampaigns\ApiClient\Api\ApiInterface;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\ToJsonTrait;
use Traversable;

abstract class AbstractCollection implements CollectionInterface
{
    use ToJsonTrait;

    public function __construct(
        /**
         * An array containing the entries of this collection.
         */
        protected array $elements = [],
        /**
         * @var array|string[] Set the default mapping for 'hydration'
         *  of a collection.
         */
        protected array $toArrayTypeMapping = [
            ApiInterface::OPERATION_GET => 'array',
            ApiInterface::OPERATION_PUT => 'iri',
            ApiInterface::OPERATION_POST => 'array',
            ApiInterface::OPERATION_PATCH => 'array'
        ]
    ) {
    }

    public function __toString(): string
    {
        return self::class . '@' . spl_object_hash($this);
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        $arr = [];
        $operation = $operation ?? ApiInterface::OPERATION_GET;
        $toType = $this->toArrayTypeMapping[$operation] ?? null;

        foreach ($this->elements as $element) {
            if ($element instanceof EntityInterface) {
                $arr[] = match ($toType) {
                    'iri' => $element->toIri(),
                    'array' => $element->toArray($operation, $isRoot),
                    default => throw new LogicException(
                        'Invalid or missing type mapping!'
                    ),
                };
            } else {
                $arr[] = $element;
            }
        }

        return $arr;
    }

    public function add(mixed $element): CollectionInterface
    {
        $this->elements[] = $element;
        return $this;
    }

    public function contains(mixed $element): bool
    {
        return in_array($element, $this->elements, true);
    }

    public function containsKey(mixed $key): bool
    {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }

    public function remove(int|string $key): mixed
    {
        if (!isset($this->elements[$key]) && !array_key_exists($key, $this->elements)) {
            return null;
        }

        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    public function removeElement(mixed $element): bool
    {
        $key = array_search($element, $this->elements, true);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }

    public function get(string|int $key): mixed
    {
        return $this->elements[$key] ?? null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->containsKey($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->add($value);

            return;
        }

        $this->set($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function set(mixed $key, mixed $value): void
    {
        $this->elements[$key] = $value;
    }

    public function __clone()
    {
        foreach ($this->elements as $key => $element) {
            $this->elements[$key] = clone $element;
        }
    }

    public function __destruct()
    {
        foreach ($this->elements as $el) {
            unset($el);
        }
    }
}
