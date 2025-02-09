<?php

namespace App\Http\Controllers\V1;

use App\Actions\Orchestrators\ApplyCampaignsOrchestrator;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;

class CartDiscountController extends Controller
{
    public function calculate(CartRequest $request, ApplyCampaignsOrchestrator $action): \Illuminate\Http\JsonResponse
    {
        return response()->json($action->execute($request->payload()));
    }
}
