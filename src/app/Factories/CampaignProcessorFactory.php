<?php

namespace App\Factories;

use App\Enums\CampaignTypeEnum;
use App\Processors\BuyXGetYFreeProcessor;
use App\Processors\CategoryDiscountProcessor;
use App\Processors\OrderTotalDiscountProcessor;

class CampaignProcessorFactory
{
    public static function make(string $campaignType)
    {
        switch ($campaignType) {
            case CampaignTypeEnum::ORDER_TOTAL_DISCOUNT->getValue():
                return new OrderTotalDiscountProcessor();
            case CampaignTypeEnum::BUY_X_GET_Y_FREE->getValue():
                return new BuyXGetYFreeProcessor();
            case CampaignTypeEnum::CATEGORY_DISCOUNT->getValue():
                return new CategoryDiscountProcessor();
            default:
                return null;
        }
    }
}
