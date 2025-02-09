<?php

namespace App\Http\Resources;

use App\Data\Campaign\CampaignCalculationPayloadDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property CampaignCalculationPayloadDTO $resource
 */
class CalculateCartDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'appliedCampaigns' => AppliedCampaignResource::collection($this->resource->campaignResult->appliedCampaigns),
            'finalTotal' => $this->resource->finalTotal,
        ];
    }
}
