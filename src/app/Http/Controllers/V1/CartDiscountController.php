<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\DiscountedCartResource;
use App\Actions\CalculateDiscountAction;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;

class CartDiscountController extends Controller
{
    public function calculate(CartRequest $request, CalculateDiscountAction $action): DiscountedCartResource
    {
        $updatedCart = $action->execute($request->payload());

        return new DiscountedCartResource($updatedCart);
    }
}
