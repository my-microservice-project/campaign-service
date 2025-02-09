<?php

namespace App\Processors\Contracts;

use App\Models\Campaign;
use App\Data\{CartDTO, AppliedCampaignDTO};

interface CampaignProcessorInterface
{
    public function process(Campaign $campaign, CartDTO $cart): ?AppliedCampaignDTO;
}

