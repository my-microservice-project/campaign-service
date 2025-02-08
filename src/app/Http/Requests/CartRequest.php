<?php

namespace App\Http\Requests;

use App\Data\CartDTO;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items'               => 'required|array',
            'items.*.product_id'    => 'required|integer',
            'items.*.quantity'      => 'required|integer|min:1',
            'items.*.unit_price'    => 'required|numeric',
            'items.*.total_price'   => 'required|numeric',
            'total_items'           => 'required|integer',
            'total_price'           => 'required|numeric',
        ];
    }

    public function payload(): CartDTO
    {
        return CartDTO::from($this->validated());
    }
}
