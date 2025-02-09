<?php

namespace App\Processors;

use App\Data\AppliedCampaignDTO;
use App\Data\CartDTO;
use App\Models\Campaign;
use App\Processors\Contracts\CampaignProcessorInterface;

class OrderTotalDiscountProcessor implements CampaignProcessorInterface
{
    public function process(Campaign $campaign, CartDTO $cart): ?AppliedCampaignDTO
    {
       return null;
    }

}
