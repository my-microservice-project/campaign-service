<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CampaignStatusEnum: int
{
    use EnumTrait;

    case DRAFT = 0;
    case ACTIVE = 1;
    case INACTIVE = 2;
    case EXPIRED = 3;

}
