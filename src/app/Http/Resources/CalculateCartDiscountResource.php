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
            'campaignResult' => CampaignResultResource::make($this->resource->campaignResult),
            'finalTotal' => $this->resource->finalTotal,
        ];
    }
}
