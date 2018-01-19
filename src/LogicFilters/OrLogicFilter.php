<?php

namespace Seredenko\LogicFilters;

use Seredenko\Operator;

/**
 * Class OrLogicFilter
 * @package Seredenko\LogicFilters
 */
class OrLogicFilter extends BaseLogicFilter implements Filterable
{
    const LOGIC_OPERATOR = Operator::LOGIC_OR;

    public function __construct(array $array, $stringFilter)
    {
        parent::__construct($array, $stringFilter);
    }

    /**
     * Logic filter of OR condition
     *
     * @param string $key
     * @param array  $value
     * @param string $k
     * @param string $op
     * @param string $v
     *
     * @return bool
     */
    protected function logicFilter($key, $value, $k, $op, $v)
    {
        if ($this->filterMask[ $key ]) {
            return false;
        }

        switch ($op) {
            case Operator::EQUAL:
                if ($value[ $k ] == $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::NOT_EQUAL:
                if ($value[ $k ] != $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::GREATER:
                if ($value[ $k ] > $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::GREATER_EQUAL:
                if ($value[ $k ] >= $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::LESS:
                if ($value[ $k ] < $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::LESS_EQUAL:
                if ($value[ $k ] <= $v) {
                    return $this->filterMask[ $key ] = true;
                }
                break;
            default:
                if ($value[ $k ] == $v) {
                    return $this->filterMask[ $key ] = false;
                }
                break;
        }

        return true;
    }
}
