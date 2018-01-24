<?php

namespace Seredenko\Filters;

use Seredenko\Operator;

/**
 * Class FieldFilter
 * @package Seredenko\Filters
 */
class FieldFilter implements Filterable
{
    protected $array;

    protected $fields = [];

    /**
     * FieldFilter constructor.
     *
     * @param array $array
     * @param       $fieldsString
     */
    public function __construct(array $array, $fieldsString)
    {
        $this->array = $array;
        $this->fields = array_map('trim',explode(Operator::FIELDS_DELIMITER,$fieldsString));
    }

    /**
     * Filter by fields
     *
     * @return array
     */
    public function filter()
    {
        foreach ($this->array as &$value) {
            $value = array_intersect_key($value, array_flip($this->fields));
        }
        return $this->array;
    }
}
