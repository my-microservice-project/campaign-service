<?php
declare(strict_types=1);

namespace App\Pipelines\Pipes;

use App\Data\Campaign\CampaignCalculationPayloadDTO;
use App\Data\Campaign\CampaignResultDTO;
use App\Data\Cart\CartDTO;
use Closure;

class CalculateFinalTotalPipe
{
    public function handle(CampaignCalculationPayloadDTO $payload, Closure $next): CampaignCalculationPayloadDTO
    {
        $cartTotal = $this->calculateCartTotal($payload->cart);

        $totalDiscount = $this->calculateTotalDiscount($payload->campaignResult);

        $payload->finalTotal = $cartTotal - $totalDiscount;

        return $next($payload);
    }

    protected function calculateCartTotal(CartDTO $cart): float
    {
        return $cart->items->sum(
            fn($item) => $item->unit_price * $item->quantity
        );
    }

    protected function calculateTotalDiscount(?CampaignResultDTO $campaignResult): float
    {

        if ($campaignResult === null) {
            return 0.0;
        }

        return $campaignResult->appliedCampaigns->sum(
            fn($appliedCampaign) => $appliedCampaign->discountDetails->discountAmount
        );
    }
}
