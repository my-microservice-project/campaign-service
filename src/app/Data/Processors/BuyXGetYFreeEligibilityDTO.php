<?php
declare(strict_types=1);

namespace App\Data\Processors;

use Spatie\LaravelData\Data;

class BuyXGetYFreeEligibilityDTO extends Data
{
    public function __construct(
        public int $productId,
        public float $unitPrice,
        public int $quantity,
        public int $categoryId,
        public int $requiredQuantity
    ) {}
}
