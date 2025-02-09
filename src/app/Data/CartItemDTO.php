<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class CartItemDTO extends Data
{
    public function __construct(
        public readonly int $product_id,
        public readonly float $unit_price,
        public readonly int $quantity,
        public ?int $categoryId = null
    ) {}
}
