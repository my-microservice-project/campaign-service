<?php

namespace App\Http\Requests;

use App\Data\Cart\CartDTO;
use App\Data\Cart\CartItemDTO;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CartRequest",
    title: "Cart Request",
    description: "Request payload for calculating cart discounts",
    required: ["items"],
    properties: [
        new OA\Property(
            property: "items",
            description: "List of cart items",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/CartItemDTO")
        )
    ],
    type: "object"
)]
class CartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ];
    }

    public function payload(): CartDTO
    {
        return CartDTO::from($this->validated());
    }
}
