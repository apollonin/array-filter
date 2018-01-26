<?php

namespace Seredenko\Filters;

use Seredenko\Exception\InvalidOperatorException;
use Seredenko\Operator;

/**
 * Class OrLogicFilter
 * @package Seredenko\Filters
 */
class OrLogicFilter extends BaseLogicFilter
{
    const LOGIC_OPERATOR = Operator::LOGIC_OR;

    /**
     * @param string $key
     * @param        $valueK
     * @param string $op
     * @param string $v
     *
     * @return bool
     * @throws InvalidOperatorException
     */
    protected function logicFilter($key, $valueK, $op, $v)
    {
        if ($this->filterMask[ $key ]) {
            return false;
        }

        switch ($op) {
            case Operator::EQUAL:
                if ($valueK == $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::NOT_EQUAL:
                if ($valueK != $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::GREATER:
                if ($valueK > $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::GREATER_EQUAL:
                if ($valueK >= $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::LESS:
                if ($valueK < $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            case Operator::LESS_EQUAL:
                if ($valueK <= $v) {
                    $this->filterMask[ $key ] = true;
                }
                break;
            default:
                throw new InvalidOperatorException();
        }

        return true;
    }
}
