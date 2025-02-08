<?php

namespace App\Discounts;

use App\Data\CartDTO;
use App\Discounts\Contracts\DiscountHandlerInterface;
use Closure;
use Illuminate\Support\Facades\Cache;

class BuyXGetYFreeDiscountHandler implements DiscountHandlerInterface
{
    public function __construct(
        protected object $campaign
    )
    {}

    public function handle(CartDTO $cart, Closure $next): CartDTO
    {
        $requiredQuantity = $this->campaign->required_quantity ?? 0;
        $freeQuantity     = $this->campaign->free_quantity ?? 0;
        $targetCategory   = $this->campaign->target->target_id ?? null; // Kampanyaya özel kategori

        // Ürünün kategori bilgisine cache üzerinden erişim (örneğin: cache('product:' . $product_id))
        $eligibleItems = $cart->items->filter(function($item) use ($targetCategory) {

            $product = Cache::get('product:' . $item->product_id);

            return $product && isset($product['category']) && $product['category'] == $targetCategory;
        });

        if ($eligibleItems->sum('quantity') >= $requiredQuantity && $freeQuantity > 0) {
            // Ücretsiz ürün uygulanacak; örneğin en düşük fiyatlı ürün üzerinden hesaplayalım.
            $eligibleSorted = $eligibleItems->sortBy('unit_price');
            $discountAmount = 0;
            $remainingFree  = $freeQuantity;
            foreach ($eligibleSorted as $item) {
                if ($remainingFree <= 0) break;
                $freeFromThisItem = min($item->quantity, $remainingFree);
                $discountAmount += $item->unit_price * $freeFromThisItem;
                $remainingFree  -= $freeFromThisItem;
            }
            $cart->total_price -= $discountAmount;
            $cart->applied_discounts->push([
                'campaign'        => $this->campaign->name,
                'type'            => 'buy_x_get_y',
                'discount_amount' => round($discountAmount, 2),
            ]);
        }

        return $next($cart);
    }
}
