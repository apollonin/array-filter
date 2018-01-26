<?php

namespace Seredenko;


use Seredenko\Filters\AndLogicFilter;
use Seredenko\Filters\FieldFilter;
use Seredenko\Filters\OrLogicFilter;
use Seredenko\Filters\RangeFilter;

final class StaticFilterFactory
{
    /**
     * @param array $arrayCopy
     * @param       $filterString
     *
     * @return AndLogicFilter|FieldFilter|OrLogicFilter|RangeFilter
     */
    public static function factory($filterString)
    {
        if (!is_string($filterString) || empty($filterString))
            throw new \InvalidArgumentException('Wrong filter string');

        if (strpos($filterString, Operator::FIELDS_DELIMITER))
        {
            return new FieldFilter($filterString);
        }
        elseif (strpos($filterString, Operator::RANGE_DELIMITER))
        {
            return new RangeFilter($filterString);
        }
        elseif (strpos($filterString, Operator::LOGIC_OR))
        {
            return new OrLogicFilter($filterString);
        }
        else
        {
            return new AndLogicFilter($filterString);
        }
    }
}