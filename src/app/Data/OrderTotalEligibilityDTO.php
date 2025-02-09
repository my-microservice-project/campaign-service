<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class OrderTotalEligibilityDTO extends Data
{
    public function __construct(
        public float $total
    ) {}
}
