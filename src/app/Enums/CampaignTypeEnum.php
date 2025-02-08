<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CampaignTypeEnum: string
{
    use EnumTrait;

    case PERCENTAGE = 'percentage';
    case BUY_X_GET_Y = 'buy_x_get_y';
    case CHEAPEST = 'cheapest';

}
