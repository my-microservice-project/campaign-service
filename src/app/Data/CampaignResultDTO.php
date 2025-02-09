<?php
declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CampaignResultDTO extends Data
{
    public function __construct(
        public readonly Collection $appliedCampaigns
    ) {}
}
