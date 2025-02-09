<?php

namespace App\Processors;

use App\Data\AppliedCampaignDTO;
use App\Data\CartDTO;
use App\Models\Campaign;
use App\Processors\Contracts\CampaignProcessorInterface;

class BuyXGetYFreeProcessor implements CampaignProcessorInterface
{
    public function process(Campaign $campaign, CartDTO $cart): ?AppliedCampaignDTO
    {
        //TODO burada aşağıya tanımlayacağın dinamik kural setlerini, ardından aksiyonları çalıştıracağız.
        /*
         * $ruleSets = $this->getRuleSets($campaign);
         * $actions = $this->getActions($campaign);
         *
         * $this->applyRules($ruleSets, $cart);
         *
         * $this->applyActions($actions, $cart);
         */
        return null;
    }

    private function getRuleSets(Campaign $campaign): array
    {
        return [];
    }

    private function getActions(Campaign $campaign): array
    {
        return [];
    }
}
