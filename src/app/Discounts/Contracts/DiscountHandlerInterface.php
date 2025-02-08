<?php

namespace App\Discounts\Contracts;

use App\Data\CartDTO;
use Closure;

interface DiscountHandlerInterface
{
    public function handle(CartDTO $cart, Closure $next): CartDTO;
}
