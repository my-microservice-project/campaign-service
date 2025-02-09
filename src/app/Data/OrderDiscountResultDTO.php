<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class OrderDiscountResultDTO extends Data
{
    public function __construct(
        public int $orderId,
        public array $discounts,
        public string $totalDiscount,
        public string $discountedTotal
    ) {}
}
