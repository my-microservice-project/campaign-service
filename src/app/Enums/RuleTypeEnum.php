<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RuleTypeEnum: string
{
    use EnumTrait;

    case MIN_TOTAL = 'min_total';
    case MIN_QUANTITY = 'min_quantity';
    case CATEGORY_ID = 'category_id';

}
