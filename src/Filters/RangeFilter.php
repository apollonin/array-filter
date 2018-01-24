<?php

namespace Seredenko\Filters;


use Seredenko\Exception\InvalidRangeFields;
use Seredenko\Operator;

class RangeFilter implements Filterable
{
    protected $array;

    private $start;
    private $end;

    /**
     * FieldFilter constructor.
     *
     * @param array $array
     * @param       $rangeString
     */
    public function __construct(array $array, $rangeString)
    {
        $this->array = $array;
        list($this->start, $this->end) = explode(Operator::RANGE_DELIMITER, $rangeString);
    }

    public function filter()
    {
        if (strcmp($this->end, $this->start) <= 0)
            throw new InvalidRangeFields();


        foreach ($this->array as $key => $value)
        {
            ksort($value);
            $startIndex = array_search($this->start,array_keys($value));
            $endIndex = array_search($this->end,array_keys($value)) + 1;

            $this->array[$key] = array_slice($value, $startIndex, $endIndex - $startIndex);
        }

        return $this->array;
    }
}