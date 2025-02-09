<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CacheEnum: string
{
    use EnumTrait;

    case PRODUCT = 'product:';
}
