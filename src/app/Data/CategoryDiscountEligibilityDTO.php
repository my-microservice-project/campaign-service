<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class CategoryDiscountEligibilityDTO extends Data
{
    public function __construct(
        public CartItemDTO $cheapestItem,
        public int $categoryId,
        public int $requiredQuantity
    ) {}
}
