<?php

namespace StoneHilt\OpenApi\Collections;

use Illuminate\Support\Collection;
use StoneHilt\OpenApi\Exceptions\ExtensionDoesNotExistException;

/**
 * Class ExtensionCollection
 *
 * @package StoneHilt\OpenApi\Collections
 * @todo Determine if get() and other methods need key normalization
 */
class ExtensionCollection extends Collection
{
    public const X_EMPTY_VALUE = 'X_EMPTY_VALUE';


    /**
     * Whether a offset exists.
     *
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $key
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($key): bool
    {
        return isset($this->items[$this->normalizeOffset($key)]);
    }

    /**
     * Offset to retrieve.
     *
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $key
     * @throws ExtensionDoesNotExistException
     * @return mixed can return all value types
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($key): mixed
    {
        if (!$this->offsetExists($key)) {
            throw new ExtensionDoesNotExistException("[{$key}] is not a valid extension.");
        }

        return $this->items[$this->normalizeOffset($key)];
    }

    /**
     * Offset to set.
     *
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $key
     * @param mixed $value
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($key, $value): void
    {
        if ($value === static::X_EMPTY_VALUE) {
            $this->offsetUnset($key);

            return;
        }

        $this->items[$this->normalizeOffset($key)] = $value;
    }

    /**
     * Offset to unset.
     *
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $key
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($key): void
    {
        if (!$this->offsetExists($key)) {
            return;
        }

        unset($this->items[$this->normalizeOffset($key)]);
    }

    /**
     * @param string $offset
     * @return string
     */
    protected function normalizeOffset($key): string
    {
        if (mb_strpos($key, 'x-') === 0) {
            return $key;
        }

        return 'x-' . $key;
    }
}
