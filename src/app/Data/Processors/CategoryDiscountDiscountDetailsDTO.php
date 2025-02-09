<?php
declare(strict_types=1);

namespace App\Data\Processors;

use Spatie\LaravelData\Data;

class CategoryDiscountDiscountDetailsDTO extends Data
{
    public function __construct(
        public int $categoryId,
        public int $requiredQuantity,
        public float $discountPercentage,
        public float $itemPrice,
        public float $discountAmount
    ) {}
}
