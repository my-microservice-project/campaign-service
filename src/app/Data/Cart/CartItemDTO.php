<?php
declare(strict_types=1);

namespace App\Data\Cart;

use Spatie\LaravelData\Data;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CartItemDTO",
    title: "Cart Item",
    description: "An item in the shopping cart",
    required: ["product_id", "unit_price", "quantity"],
    properties: [
        new OA\Property(property: "product_id", description: "ID of the product", type: "integer"),
        new OA\Property(property: "unit_price", description: "Unit price of the product", type: "number", format: "float"),
        new OA\Property(property: "quantity", description: "Quantity of the product", type: "integer"),
        new OA\Property(property: "categoryId", description: "Optional category ID", type: "integer", nullable: true)
    ],
    type: "object"
)]
class CartItemDTO extends Data
{
    public function __construct(
        public readonly int $product_id,
        public readonly float $unit_price,
        public readonly int $quantity,
        public ?int $categoryId = null
    ) {}
}
