<?php
declare(strict_types=1);

namespace App\Processors\Contracts;

use App\Models\Campaign;
use App\Data\CartDTO;
use Illuminate\Support\Collection;

interface CampaignProcessorInterface
{
    public function process(Campaign $campaign, CartDTO $cart): Collection;
}
