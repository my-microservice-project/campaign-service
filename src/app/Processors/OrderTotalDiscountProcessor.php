<?php
declare(strict_types=1);

namespace App\Processors;

use App\Processors\Abstracts\AbstractCampaignProcessor;
use App\Data\CartDTO;
use App\Models\Campaign;
use App\Enums\RuleTypeEnum;
use App\Enums\ActionTypeEnum;
use Illuminate\Support\Collection;
use App\Data\OrderTotalEligibilityDTO;
use App\Data\OrderTotalDiscountDetailsDTO;

class OrderTotalDiscountProcessor extends AbstractCampaignProcessor
{
    protected string $actionType = ActionTypeEnum::DISCOUNT_PERCENTAGE->value;

    protected function validateRules(Campaign $campaign, CartDTO $cart): Collection
    {
        $minTotalRule = $campaign->rules()->where('rule_type', RuleTypeEnum::MIN_TOTAL->value)->first() ?? collect();

        $total = $cart->items->sum(fn($item) => $item->unit_price * $item->quantity);

        if ($total < $minTotalRule->value) return collect();

        return collect([new OrderTotalEligibilityDTO($total)]) ?? collect();
    }

    protected function calculateDiscount(object $payload, object $action): ?object
    {
        /** @var OrderTotalEligibilityDTO $payload */
        $total = $payload->total;

        $discountAmount = ($total * $action->value) / 100;

        return new OrderTotalDiscountDetailsDTO(
            total: $total,
            discountPercentage: $action->value,
            discountAmount: $discountAmount,
            finalTotal: $total - $discountAmount
        );
    }
}
