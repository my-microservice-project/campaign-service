<?php

namespace App\Http\Resources;

use App\Data\Campaign\AppliedCampaignDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property AppliedCampaignDTO $resource
 */
class AppliedCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'campaignName'   => $this->resource->campaignName,
            'campaignType'   => $this->resource->campaignType,
            'discountDetails'=> DiscountDetailsResource::make($this->resource->discountDetails),
        ];
    }
}
