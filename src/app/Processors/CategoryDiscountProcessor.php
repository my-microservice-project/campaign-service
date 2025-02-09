<?php
declare(strict_types=1);

namespace App\Processors;

use App\Data\Cart\CartDTO;
use App\Data\Processors\CategoryDiscountDiscountDetailsDTO;
use App\Data\Processors\CategoryDiscountEligibilityDTO;
use App\Enums\ActionTypeEnum;
use App\Enums\RuleTypeEnum;
use App\Models\Campaign;
use App\Processors\Abstracts\AbstractCampaignProcessor;
use Illuminate\Support\Collection;

class CategoryDiscountProcessor extends AbstractCampaignProcessor
{
    protected string $actionType = ActionTypeEnum::DISCOUNT_PERCENTAGE->value;

    /**
     * @param Campaign $campaign
     * @param CartDTO  $cart
     * @return Collection<int, CategoryDiscountEligibilityDTO>
     */
    protected function validateRules(Campaign $campaign, CartDTO $cart): Collection
    {
        $categoryRule = $campaign->rules()->where('rule_type', RuleTypeEnum::CATEGORY_ID->value)->first();
        $quantityRule = $campaign->rules()->where('rule_type', RuleTypeEnum::MIN_QUANTITY->value)->first();

        if ($categoryRule === null || $quantityRule === null) {
            return collect();
        }

        $categoryItems = $cart->items->toCollection()->filter(
            fn($item) => $item->categoryId === $categoryRule->value
        ) ?? collect();

        $totalQuantity = $categoryItems->sum(fn($item) => $item->quantity);
        if ($totalQuantity < $quantityRule->value) {
            return collect();
        }

        $cheapestItem = $categoryItems->sortBy('unit_price')->first() ??  collect();

        return collect([
            new CategoryDiscountEligibilityDTO(
                cheapestItem: $cheapestItem,
                categoryId: $categoryRule->value,
                requiredQuantity: $quantityRule->value
            )
        ]) ?? collect();
    }

    /**
     * @param object $payload
     * @param object $action
     * @return object|null
     */
    protected function calculateDiscount(object $payload, object $action): ?object
    {
        /** @var CategoryDiscountEligibilityDTO $payload */
        $unitPrice = $payload->cheapestItem->unit_price;
        $discountAmount = ($unitPrice * $action->value) / 100;

        return new CategoryDiscountDiscountDetailsDTO(
            categoryId: $payload->categoryId,
            requiredQuantity: $payload->requiredQuantity,
            discountPercentage: $action->value,
            itemPrice: $unitPrice,
            discountAmount: $discountAmount
        );
    }
}
