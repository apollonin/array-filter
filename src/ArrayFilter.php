<?php

namespace Seredenko;

use Seredenko\LogicFilters\AndLogicFilter;
use Seredenko\LogicFilters\FieldFilter;
use Seredenko\LogicFilters\OrLogicFilter;

class ArrayFilter extends \ArrayObject
{
    /**
     * Whether a offset exists
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     * @param string $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     * @return \ArrayObject Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($filterString)
    {
        if (strpos($filterString, Operator::LOGIC_AND)) {
            $filter = new AndLogicFilter($this->getArrayCopy(), $filterString);
        } elseif (strpos($filterString, Operator::LOGIC_OR)) {
            $filter = new OrLogicFilter($this->getArrayCopy(), $filterString);
        } else {
            $filter = new FieldFilter($this->getArrayCopy(), $filterString);
        }

        return new $this($filter->filter());
    }

    /**
     * Offset to set
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function __call($func, $argv)
    {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_')
        {
            throw new \BadMethodCallException(__CLASS__.'->'.$func);
        }
        return call_user_func_array($func, array_merge(array($this->array), $argv));
    }
}
