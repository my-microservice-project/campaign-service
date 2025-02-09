<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class OrderTotalDiscountDetailsDTO extends Data
{
    public function __construct(
        public float $total,
        public float $discountPercentage,
        public float $discountAmount,
        public float $finalTotal
    ) {}
}
