<?php

declare(strict_types=1);

namespace App\Pipelines\Pipes;

use App\Contracts\CampaignPipeInterface;
use App\Data\Campaign\CampaignCalculationPayloadDTO;
use App\Data\Cart\CartItemDTO;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Closure;

class AssignCategoryToCartItemsPipe implements CampaignPipeInterface
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    public function handle(CampaignCalculationPayloadDTO $payload, Closure $next): CampaignCalculationPayloadDTO
    {
        $payload->cart->items
            ->toCollection()
            ->each(function (CartItemDTO $item): void {
                $product = $this->productRepository->getProductById($item->product_id);

                $item->categoryId = $product?->category;
            });

        return $next($payload);
    }
}
