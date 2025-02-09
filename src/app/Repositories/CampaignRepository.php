<?php

namespace App\Repositories;

use App\Enums\CampaignStatusEnum;
use App\Models\Campaign;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use Illuminate\Support\Collection;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function getActiveCampaigns(): Collection
    {
        return Campaign::where('active', CampaignStatusEnum::ACTIVE->getValue())
            ->where(function ($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>=', now());
            })
            ->orderBy('priority')
            ->with(['rules', 'actions'])
            ->get();
    }

}
