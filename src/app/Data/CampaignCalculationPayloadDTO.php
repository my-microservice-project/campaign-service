<?php
declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class CampaignCalculationPayloadDTO extends Data
{
    public function __construct(
        public CartDTO $cart,
        public ?CampaignResultDTO $campaignResult = null,
        public ?float $finalTotal = null
    ) {}
}
