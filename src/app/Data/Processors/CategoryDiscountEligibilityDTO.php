<?php
declare(strict_types=1);

namespace App\Data\Processors;

use App\Data\Cart\CartItemDTO;
use Spatie\LaravelData\Data;

class CategoryDiscountEligibilityDTO extends Data
{
    public function __construct(
        public CartItemDTO $cheapestItem,
        public int $categoryId,
        public int $requiredQuantity
    ) {}
}
