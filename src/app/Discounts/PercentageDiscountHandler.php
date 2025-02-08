<?php

namespace App\Discounts;

use App\Data\CartDTO;
use App\Discounts\Contracts\DiscountHandlerInterface;
use Closure;

class PercentageDiscountHandler implements DiscountHandlerInterface
{
    public function __construct(
        protected object $campaign
    )
    {}

    public function handle(CartDTO $cart, Closure $next): CartDTO
    {
        $minOrderAmount    = $this->campaign->min_order_amount ?? 0;
        $discountPercentage = $this->campaign->discount_percentage ?? 0;

        if ($discountPercentage > 0 && $cart->total_price >= $minOrderAmount) {

            $discountAmount = $cart->total_price * ($discountPercentage / 100);
            $cart->total_price -= $discountAmount;

            $cart->applied_discounts->push([
                'campaign'        => $this->campaign->name,
                'type'            => 'percentage',
                'discount_amount' => round($discountAmount, 2),
            ]);

        }

        return $next($cart);
    }
}
