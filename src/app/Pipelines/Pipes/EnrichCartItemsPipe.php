<?php
declare(strict_types=1);

namespace App\Pipelines\Pipes;

use Closure;
use App\Data\CampaignCalculationPayloadDTO;
use App\Data\CartItemDTO;
use App\Repositories\Contracts\ProductRepositoryInterface;

class EnrichCartItemsPipe
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    public function handle(CampaignCalculationPayloadDTO $payload, Closure $next): CampaignCalculationPayloadDTO
    {
        $payload->cart->items->each(function (CartItemDTO $item): void {
            $product = $this->productRepository->getProductById($item->product_id);
            $item->categoryId = $product->category;
        });

        return $next($payload);
    }
}
