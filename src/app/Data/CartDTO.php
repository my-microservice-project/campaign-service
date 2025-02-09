<?php
declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CartDTO extends Data
{
    public function __construct(
        public readonly Collection $items
    ) {}
}
