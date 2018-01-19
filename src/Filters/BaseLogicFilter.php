<?php

namespace Seredenko\Filters;

/**
 * Class BaseLogicFilter
 * @package Seredenko\Filters
 */
abstract class BaseLogicFilter
{
    const LOGIC_OPERATOR = null;

    protected $array;

    protected $conditions = [];

    protected $filterMask = [];

    /**
     * Init class and explode filter string to normal array of conditions
     *
     * BaseLogicFilter constructor.
     *
     * @param array $array
     * @param       $stringFilter
     */
    public function __construct(array $array, $stringFilter)
    {
        $this->array = $array;

        $this->filterMask = array_fill(0, count($this->array), false);

        foreach (explode(static::LOGIC_OPERATOR, $stringFilter) as $filter) {
            $this->conditions[] = explode(' ', trim($filter));
        }
    }

    /**
     * Checking variable $v always string. For filter we need change string to another types, like boolean or int.
     *
     * @param $v
     */
    protected function convertVariableType(&$v)
    {
        if (is_int($v)) {
            $v = intval($v);
        } elseif (is_float($v)) {
            $v = floatval($v);
        } elseif ($v == 'true' || $v == 'false') {
            $v = $v == 'true' ? true : false;
        } elseif ($v == '' || $v == 'null') {
            $v = null;
        }
    }

    /**
     * Main filter with using filterMask
     *
     * @return array
     */
    public function filter()
    {
        foreach ($this->array as $key => $value) {
            foreach ($this->conditions as list($k, $op, $v)) {
                $this->convertVariableType($v);

                if (!$this->logicFilter($key, $value, $k, $op, $v)) {
                    continue 2;
                }
            }
        }

        $this->array = array_intersect_key($this->array, array_flip(array_keys($this->filterMask, true)));

        return $this->array;
    }

    /**
     * Main function for Filters
     *
     * @param string $key
     * @param array $value
     * @param string $k
     * @param string $op
     * @param string $v
     *
     * @return bool
     */
    abstract protected function logicFilter($key, $value, $k, $op, $v);
}
