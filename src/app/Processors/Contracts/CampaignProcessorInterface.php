<?php
declare(strict_types=1);

namespace App\Processors\Contracts;

use App\Data\Cart\CartDTO;
use App\Models\Campaign;
use Illuminate\Support\Collection;

interface CampaignProcessorInterface
{
    public function process(Campaign $campaign, CartDTO $cart): Collection;
}
