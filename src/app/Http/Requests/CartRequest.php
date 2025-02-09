<?php

namespace App\Http\Requests;

use App\Data\Cart\CartDTO;
use App\Data\Cart\CartItemDTO;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items'               => 'required|array',
            'items.*.product_id'  => 'required|integer',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0'
        ];
    }

    public function payload(): CartDTO
    {
        $cartItems = collect($this->validated()['items'])
            ->map(fn($item) => CartItemDTO::from($item));

        return CartDTO::from(['items' => $cartItems]);
    }
}
