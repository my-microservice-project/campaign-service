<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TargetTypeEnum: string
{
    use EnumTrait;

    case CATEGORY = 'category';
    case USER = 'user';
    case BRAND = 'brand';
    case PRODUCT = 'product';
    case CART = 'cart';

}
