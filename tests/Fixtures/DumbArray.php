<?php
/**
 * @copyright 2009-2023 Vanilla Forums Inc.
 * @license MIT
 */

namespace Garden\Utils\Tests\Fixtures;

/**
 * An array object that just implements `ArrayAccess`.
 */
class DumbArray implements \ArrayAccess, \JsonSerializable
{
    /**
     * @var array
     */
    protected $arr;

    /**
     * DumbArray constructor.
     *
     * @param array $arr
     */
    public function __construct(array $arr = [])
    {
        $this->arr = $arr;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return $this->arr;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->arr);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->arr[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->arr[] = $value;
        } else {
            $this->arr[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->arr[$offset]);
    }
}
