<?php
declare(strict_types=1);

namespace App\Actions\Orchestrators;

use App\Data\Campaign\CampaignCalculationPayloadDTO;
use App\Data\Cart\CartDTO;
use App\Pipelines\Pipes\{ApplyCampaignsPipe, CalculateFinalTotalPipe, EnrichCartItemsPipe};
use Illuminate\Pipeline\Pipeline;

class ApplyCampaignsOrchestrator
{
    public static function execute(CartDTO $cart): CampaignCalculationPayloadDTO
    {
        $payload = new CampaignCalculationPayloadDTO($cart);

        return app(Pipeline::class)
            ->send($payload)
            ->through([
                EnrichCartItemsPipe::class,
                ApplyCampaignsPipe::class,
                CalculateFinalTotalPipe::class,
            ])
            ->then(fn(CampaignCalculationPayloadDTO $payload): CampaignCalculationPayloadDTO => $payload);
    }
}
