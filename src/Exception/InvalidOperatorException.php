<?php

namespace Seredenko\Exception;

class InvalidOperatorException extends \Exception
{
    protected $message = 'Filter use invalid operator. Use only one of [==, != , >, <, >=, <=]';
}