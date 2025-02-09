<?php
declare(strict_types=1);

namespace App\Processors;

use App\Data\Cart\CartDTO;
use App\Data\Processors\BuyXGetYFreeDiscountDetailsDTO;
use App\Data\Processors\BuyXGetYFreeEligibilityDTO;
use App\Enums\ActionTypeEnum;
use App\Enums\RuleTypeEnum;
use App\Models\Campaign;
use App\Processors\Abstracts\AbstractCampaignProcessor;
use Illuminate\Support\Collection;

class BuyXGetYFreeProcessor extends AbstractCampaignProcessor
{
    protected string $actionType = ActionTypeEnum::FREE_PRODUCT_QUANTITY->value;

    protected function validateRules(Campaign $campaign, CartDTO $cart): Collection
    {
        $categoryRule = $campaign->rules()->where('rule_type', RuleTypeEnum::CATEGORY_ID->value)->first();
        $quantityRule = $campaign->rules()->where('rule_type', RuleTypeEnum::MIN_QUANTITY->value)->first();

        if ($categoryRule === null || $quantityRule === null) {
            return collect();
        }

        $eligiblePayloads = collect();

        foreach ($cart->items as $item) {
            if ($item->categoryId === $categoryRule->value && $item->quantity >= $quantityRule->value) {
                $eligiblePayloads->push(new BuyXGetYFreeEligibilityDTO(
                    productId: $item->product_id,
                    unitPrice: $item->unit_price,
                    quantity: $item->quantity,
                    categoryId: $categoryRule->value,
                    requiredQuantity: $quantityRule->value
                ));
            }
        }

        return $eligiblePayloads ?? collect();
    }

    protected function calculateDiscount(object $payload, object $action): ?object
    {
        /** @var BuyXGetYFreeEligibilityDTO $payload */

        $groupCount = (int) floor($payload->quantity / $payload->requiredQuantity);

        $freeQuantity = $groupCount * $action->value;
        $discountAmount = $payload->unitPrice * $freeQuantity;

        return new BuyXGetYFreeDiscountDetailsDTO(
            productId: $payload->productId,
            categoryId: $payload->categoryId,
            requiredQuantity: $payload->requiredQuantity,
            freeQuantity: $freeQuantity,
            unitPrice: $payload->unitPrice,
            discountAmount: $discountAmount
        );
    }
}
