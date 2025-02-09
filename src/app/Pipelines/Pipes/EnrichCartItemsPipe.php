<?php

namespace App\Pipelines\Pipes;

use App\Data\CartDTO;
use App\Data\CartItemDTO;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Closure;

class EnrichCartItemsPipe
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function handle(CartDTO $cart, Closure $next)
    {

        $cart->items->each(function (CartItemDTO $item) {
            $product = $this->productRepository->getProductById($item->product_id);
            $item->categoryId = $product->category;
        });

        return $next($cart);
    }

}
