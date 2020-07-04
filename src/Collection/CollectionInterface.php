<?php

namespace MailCampaigns\ApiClient\Collection;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Copyright (c) 2006-2013 Doctrine Project
 *
 * This is a stripped-down and slightly altered version of Doctrine Project's
 * Collection by MailCampaigns (Bert van der Genugten). For more information
 * on the original code refer to: https://www.doctrine-project.org/projects/collections.html
 */
interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{
    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     *
     * @psalm-return array<TKey,T>
     */
    public function toArray() : array;

    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element The element to add.
     * @return bool
     */
    public function add($element) : bool;

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     * @return bool TRUE if the collection contains the element, FALSE otherwise.
     */
    public function contains($element) : bool;

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param string|int $key The key/index to check for.
     * @return bool TRUE if the collection contains an element with the specified key/index,
     *              FALSE otherwise.
     */
    public function containsKey($key) : bool;

    /**
     * Gets the element at the specified key/index.
     *
     * @param string|int $key The key/index of the element to retrieve.
     * @return mixed
     */
    public function get($key);

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|int $key The key/index of the element to remove.
     * @return mixed The removed element or NULL, if the collection did not contain the element.
     */
    public function remove($key);

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeElement($element) : bool;

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|int $key   The key/index of the element to set.
     * @param mixed      $value The element to set.
     *
     * @psalm-param TKey $key
     * @psalm-param T $value
     */
    public function set($key, $value) : void;
}
