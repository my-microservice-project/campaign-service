<?php

declare(strict_types=1);

namespace App\Actions\Orchestrators;

use App\Data\Campaign\CampaignCalculationPayloadDTO;
use App\Data\Cart\CartDTO;
use Illuminate\Pipeline\Pipeline;

class ApplyCampaignsOrchestrator
{
    public static function execute(CartDTO $cart): CampaignCalculationPayloadDTO
    {
        $payload = new CampaignCalculationPayloadDTO($cart);

        /**
         * @see config/campaings.php
         */
        return app(Pipeline::class)
            ->send($payload)
            ->through(config('campaigns.steps'))
            ->then(fn(CampaignCalculationPayloadDTO $payload): CampaignCalculationPayloadDTO => $payload);
    }
}
