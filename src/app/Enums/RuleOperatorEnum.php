<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RuleOperatorEnum: string
{
    use EnumTrait;

    case GREATER = '>';
    case LESS = '<';
    case EQUAL = '=';
    case GREATER_OR_EQUAL = '>=';
    case LESS_OR_EQUAL = '<=';

}
