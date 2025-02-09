<?php

namespace App\Http\Controllers\V1;

use App\Actions\Orchestrators\ApplyCampaignsOrchestrator;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalculateCartDiscountResource;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Cart Discounts",
    description: "API Endpoints for cart discount calculations"
)]
class CartDiscountController extends Controller
{
    #[OA\PathItem(path: "/api/v1/calculate-discount")]
    #[OA\Post(
        description: "Calculates applicable discounts and campaigns for the given cart items",
        summary: "Calculate discounts for cart items",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CartRequest",
                example: [
                    "items" => [
                        [
                            "product_id" => 100,
                            "quantity"   => 2,
                            "unit_price" => 120.75,
                        ],
                        [
                            "product_id" => 101,
                            "quantity"   => 1,
                            "unit_price" => 49.50,
                        ],
                        [
                            "product_id" => 102,
                            "quantity"   => 1,
                            "unit_price" => 11.28,
                        ],
                        [
                            "product_id" => 103,
                            "quantity"   => 6,
                            "unit_price" => 22.80,
                        ],
                        [
                            "product_id" => 104,
                            "quantity"   => 2,
                            "unit_price" => 12.95,
                        ]
                    ]
                ]
            )
        ),
        tags: ["Cart Discounts"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/CampaignResultDTO")
            ),
            new OA\Response(
                response: 422,
                description: "Validation error",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string"),
                        new OA\Property(property: "errors", type: "object")
                    ]
                )
            )
        ]
    )]
    public function calculate(CartRequest $request, ApplyCampaignsOrchestrator $action): CalculateCartDiscountResource
    {
        return CalculateCartDiscountResource::make($action->execute($request->payload()))->additional(['success' => true]);
    }
}
