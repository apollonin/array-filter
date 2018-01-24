<?php

namespace Seredenko\Exception;


class InvalidRangeFields extends \Exception
{
    protected $message = 'Invalid range fields. First field must be bigger than second';
}