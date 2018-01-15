<?php

namespace Seredenko;

abstract class Operator
{
    const EQUAL = '==';
    const GREATER = '>';
    const GREATER_EQUAL = '>=';
    const LESS = '<';
    const LESS_EQUAL = '<=';
    const NOT_EQUAL = '!=';
    const LOGIC_AND = '&&';
    const LOGIC_OR = '||';

    /**
     * @var string[]
     */
    public static $operators = [
        self::EQUAL,
        self::GREATER,
        self::GREATER_EQUAL,
        self::LESS,
        self::LESS_EQUAL,
        self::NOT_EQUAL
    ];
}
