<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CampaignTypeEnum: string
{
    use EnumTrait;

    case ORDER_TOTAL_DISCOUNT = 'order_total_discount';
    case BUY_X_GET_Y_FREE = 'buy_x_get_y_free';
    case CATEGORY_DISCOUNT = 'category_discount';

}
