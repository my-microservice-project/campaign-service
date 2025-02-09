<?php
declare(strict_types=1);

namespace App\Factories;

use App\Enums\CampaignTypeEnum;
use App\Processors\BuyXGetYFreeProcessor;
use App\Processors\CategoryDiscountProcessor;
use App\Processors\OrderTotalDiscountProcessor;
use App\Processors\Contracts\CampaignProcessorInterface;

class CampaignProcessorFactory
{
    public static function make(string $campaignType): ?CampaignProcessorInterface
    {
        return match ($campaignType) {
            CampaignTypeEnum::ORDER_TOTAL_DISCOUNT->getValue() => new OrderTotalDiscountProcessor(),
            CampaignTypeEnum::BUY_X_GET_Y_FREE->getValue() => new BuyXGetYFreeProcessor(),
            CampaignTypeEnum::CATEGORY_DISCOUNT->getValue() => new CategoryDiscountProcessor(),
            default => null,
        };
    }
}
