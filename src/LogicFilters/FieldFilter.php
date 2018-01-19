<?php

namespace Seredenko\LogicFilters;


class FieldFilter implements Filterable
{
    protected $array;

    protected $fields = [];

    public function __construct(array $array, $fieldsString)
    {
        $this->array = $array;
        $this->fields = explode(':', $fieldsString);
    }

    public function filter()
    {
        foreach ($this->array as &$value)
        {
            $value = array_intersect_key($value, array_flip($this->fields));
        }
        return $this->array;
    }
}