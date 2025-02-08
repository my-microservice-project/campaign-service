<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RuleTypeEnum: string
{
    use EnumTrait;

    case CART_AMOUNT = 'cart_amount';
    case PRODUCT_QUANTITY = 'product_quantity';

}
