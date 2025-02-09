<?php
declare(strict_types=1);

namespace App\Data\Cart;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CartDTO extends Data
{
    public function __construct(
        #[DataCollectionOf(CartItemDTO::class)]
        public readonly DataCollection $items
    ) {}
}
