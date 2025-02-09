<?php
declare(strict_types=1);

namespace App\Data\Campaign;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CampaignResultDTO",
    title: "Campaign Result",
    description: "Result of campaign calculations",
    required: ["appliedCampaigns"],
    properties: [
        new OA\Property(
            property: "appliedCampaigns",
            description: "List of applied campaigns",
            type: "array",
            items: new OA\Items(type: "object")
        )
    ],
    type: "object"
)]
class CampaignResultDTO extends Data
{
    public function __construct(
        public readonly Collection $appliedCampaigns
    ) {}
}
