<?php

namespace App\Data\Product;

use Spatie\LaravelData\Data;

class ProductDTO extends Data
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $description,
        public int $category,
        public float $price,
    )
    {}
}
