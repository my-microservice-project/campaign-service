<?php

namespace App\Actions\Orchestrators;

use App\Pipelines\Pipes\{ApplyCampaignsPipe,EnrichCartItemsPipe};
use App\Data\{CampaignResultDTO,CartDTO};
use Illuminate\Pipeline\Pipeline;

class ApplyCampaignsOrchestrator
{
    public static function execute(CartDTO $cart): CampaignResultDTO
    {
        return app(Pipeline::class)
            ->send($cart)
            ->through([
                EnrichCartItemsPipe::class,
                ApplyCampaignsPipe::class,
            ])
            ->then(function ($payload) {
                return $payload['campaignResult'];
            });
    }
}
