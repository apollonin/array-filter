<?php

namespace Seredenko\LogicFilters;

use Seredenko\Operator;

/**
 * Class AndLogicFilter
 * @package Seredenko\LogicFilters
 */
class AndLogicFilter extends BaseLogicFilter
{
    const LOGIC_OPERATOR = Operator::LOGIC_AND;

    public function __construct(array $array, $stringFilter)
    {
        parent::__construct($array, $stringFilter);
    }

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
    protected function logicFilter($key, $value, $k, $op, $v)
    {
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
                return $this->filterMask[ $key ] = false;

                break;
        }

        return $this->filterMask[ $key ] = false;
    }
}
