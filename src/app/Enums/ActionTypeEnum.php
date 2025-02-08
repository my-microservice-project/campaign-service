<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ActionTypeEnum: string
{
    use EnumTrait;

    case PERCENTAGE_DISCOUNT = 'percentage_discount';
    case FIXED_DISCOUNT = 'fixed_discount';
    case FREE_PRODUCT = 'free_product';

}
