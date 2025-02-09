<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RuleOperatorEnum: string
{
    use EnumTrait;

    case GREATER_OR_EQUAL = '>=';
    case EQUAL = '==';
    case GREATER = '>';

}
