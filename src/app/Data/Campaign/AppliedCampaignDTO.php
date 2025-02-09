<?php
declare(strict_types=1);

namespace App\Data\Campaign;

use Spatie\LaravelData\Data;

class AppliedCampaignDTO extends Data
{
    public function __construct(
        public string $campaignName,
        public string $campaignType,
        public object $discountDetails,
        public object $campaign
    ) {}
}
