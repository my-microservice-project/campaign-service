<?php

namespace App\Contracts;

use App\Data\Campaign\CampaignCalculationPayloadDTO;
use Closure;

interface CampaignPipeInterface
{
    public function handle(CampaignCalculationPayloadDTO $payload, Closure $next): CampaignCalculationPayloadDTO;
}
