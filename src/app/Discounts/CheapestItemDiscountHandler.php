<?php

namespace App\Discounts;

use App\Data\CartDTO;
use App\Discounts\Contracts\DiscountHandlerInterface;
use Closure;

class CheapestItemDiscountHandler implements DiscountHandlerInterface
{
    public function __construct(
        protected object $campaign
    )
    {}

    public function handle(CartDTO $cart, Closure $next): CartDTO
    {
        $requiredQuantity   = $this->campaign->required_quantity ?? 0;
        $discountPercentage = $this->campaign->discount_percentage ?? 0;
        $targetCategory     = $this->campaign->target_category ?? null;

        $eligibleItems = $cart->items->filter(function($item) use ($targetCategory) {
            $product = cache('product:' . $item->product_id);
            return $product && isset($product['category_id']) && $product['category_id'] == $targetCategory;
        });

        if ($eligibleItems->sum('quantity') >= $requiredQuantity && $discountPercentage > 0) {
            $cheapest = $eligibleItems->sortBy('unit_price')->first();
            if ($cheapest) {
                $discountAmount = $cheapest->unit_price * ($discountPercentage / 100);
                $cart->total_price -= $discountAmount;
                $cart->applied_discounts->push([
                    'campaign'        => $this->campaign->name,
                    'type'            => 'cheapest',
                    'discount_amount' => round($discountAmount, 2),
                ]);
            }
        }
        return $next($cart);
    }
}
