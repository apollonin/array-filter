<?php

namespace Seredenko\Filters;

use Seredenko\Exception\InvalidOperatorException;
use Seredenko\Operator;

/**
 * Class AndLogicFilter
 * @package Seredenko\Filters
 */
class AndLogicFilter extends BaseLogicFilter
{
    const LOGIC_OPERATOR = Operator::LOGIC_AND;

    /**
     * Logic filter of AND condition
     *
     * @param string $key
     * @param array  $value
     * @param string $k
     * @param string $op
     * @param string $v
     *
     * @return bool
     */
    protected function logicFilter($key, $valueK, $op, $v)
    {
        switch ($op) {
            case Operator::EQUAL:
                    $this->filterMask[ $key ] = $valueK == $v ? true : false;
                break;
            case Operator::NOT_EQUAL:
                    $this->filterMask[ $key ] = $valueK != $v ? true : false;
                break;
            case Operator::GREATER:
                    $this->filterMask[ $key ] = $valueK > $v ? true : false;
                break;
            case Operator::GREATER_EQUAL:
                    $this->filterMask[ $key ] = $valueK >= $v ? true : false;
                break;
            case Operator::LESS:
                    $this->filterMask[ $key ] = $valueK < $v ? true : false;
                break;
            case Operator::LESS_EQUAL:
                    $this->filterMask[ $key ] = $valueK <= $v ? true : false;
                break;
            default:
                throw new InvalidOperatorException();
        }

        return $this->filterMask[ $key ];
    }
}
