<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Collection;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Copyright (c) 2006-2013 Doctrine Project
 *
 * This is a stripped-down, altered version of Doctrine Project's
 * Collection by MailCampaigns (Bert van der Genugten). For more information
 * on the original code refer to: https://www.doctrine-project.org/projects/collections.html
 */
interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{
    /**
     * Gets a native PHP array representation of the collection.
     */
    public function toArray(?string $operation = null, ?bool $isRoot = null): array;

    /**
     * Adds an element at the end of the collection.
     */
    public function add(mixed $element): self;

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     */
    public function contains(mixed $element): bool;

    /**
     * Checks whether the collection contains an element with the specified key/index.
     */
    public function containsKey(string|int $key): bool;

    /**
     * Gets the element at the specified key/index.
     */
    public function get(string|int $key): mixed;

    /**
     * Removes the element at the specified index from the collection.
     */
    public function remove(string|int $key): mixed;

    /**
     * Removes the specified element from the collection, if it is found.
     */
    public function removeElement(mixed $element): bool;

    /**
     * Sets an element in the collection at the specified key/index.
     */
    public function set(string|int $key, mixed $value): void;
}
