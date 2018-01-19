<?php

namespace Seredenko\Filters;

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
        $this->fields = explode(':', $fieldsString);
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
