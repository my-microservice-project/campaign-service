<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CampaignRepositoryInterface
{
    public function getActiveCampaigns(): Collection;
}
