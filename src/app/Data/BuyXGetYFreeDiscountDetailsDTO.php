<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class BuyXGetYFreeDiscountDetailsDTO extends Data
{
    public function __construct(
        public int $productId,
        public int $categoryId,
        public int $requiredQuantity,
        public int $freeQuantity,
        public float $unitPrice,
        public float $discountAmount
    ) {}
}
