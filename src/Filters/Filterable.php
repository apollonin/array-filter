<?php

namespace Seredenko\Filters;

/**
 * Interface Filterable
 * @package Seredenko\Filters
 */
interface Filterable
{
    public function filter();

    public function setArray(array $arrayCopy);
}
