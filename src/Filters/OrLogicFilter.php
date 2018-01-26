<?php

namespace Seredenko\Filters;

use Seredenko\Operator;

/**
 * Class OrLogicFilter
 * @package Seredenko\Filters
 */
class OrLogicFilter extends BaseLogicFilter
{
    const LOGIC_OPERATOR = Operator::LOGIC_OR;

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
