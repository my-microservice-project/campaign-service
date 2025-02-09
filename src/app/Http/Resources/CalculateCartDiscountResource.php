<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
