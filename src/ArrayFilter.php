<?php

namespace Seredenko;

/**
 * Class ArrayFilter
 *
 * @method array array_values()
 * @method array array_keys()
 *
 * @package Seredenko
 */
class ArrayFilter extends \ArrayObject
{
    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string $offset <p>
     *                       The offset to retrieve.
     *                       </p>
     *
     * @return ArrayFilter Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($filterString)
    {
        $filter = StaticFilterFactory::factory($filterString);
        $filter->setArray($this->getArrayCopy());

        return new $this($filter->filter());
    }

    /**
     * Set new value for each key in filtered array
     *
     * @param mixed $key
     * @param mixed $newValue
     */
    public function offsetSet($key, $newValue)
    {
        foreach ($this as &$value)
        {
            $value[ $key ] = $newValue;
        }
    }

    /**
     * Use magic method for realize array functions for this object
     *
     * @param $func
     * @param $argv
     *
     * @return mixed
     */
    public function __call($func, $argv)
    {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_')
        {
            throw new \BadMethodCallException(__CLASS__ . '->' . $func);
        }

        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
    }
}
