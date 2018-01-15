<?php

namespace Seredenko;

use Seredenko\LogicFilters\AndLogicFilter;
use Seredenko\LogicFilters\OrLogicFilter;

class ArrayFilter implements \ArrayAccess
{
    /**
     * @var array
     */
    public $array;

    /**
     * Array of filters by condition (AND or OR)
     *
     * @var array
     */
    private $filters = [];

    /**
     * ArrayFilter constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    /**
     * Filter array by condition
     *
     * @param array $array
     *
     * @return array
     */
    public function filter()
    {
        $res = [];
        foreach ($this->filters as $filter) {
            $res = array_merge($res, $filter->filter());
        }

        return $res;
    }

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
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($filterString)
    {
        if (strstr($filterString, Operator::LOGIC_AND)) {
            $this->filters[] = new AndLogicFilter($this->array, $filterString);
        } elseif (strstr($filterString, Operator::LOGIC_OR)) {
            $this->filters[] = new OrLogicFilter($this->array, $filterString);
        } else {
            $this->filters[] = new AndLogicFilter($this->array, $filterString);
        }

        return $this->filter();
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
}
