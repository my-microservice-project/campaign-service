<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountedCartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'items'             => $this->resource->items,
            'total_items'       => $this->resource->total_items,
            'total_price'       => $this->resource->total_price,
            'applied_discounts' => $this->resource->applied_discounts,
        ];
    }
}
