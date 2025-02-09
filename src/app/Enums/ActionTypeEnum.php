<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ActionTypeEnum: string
{
    use EnumTrait;

    case DISCOUNT_PERCENTAGE = 'discount_percentage';
    case FREE_PRODUCT_QUANTITY = 'free_product_quantity';
}
