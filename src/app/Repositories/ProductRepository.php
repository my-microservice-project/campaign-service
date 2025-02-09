<?php

namespace App\Repositories;

use App\Data\Product\ProductDTO;
use App\Enums\CacheEnum;
use App\Exceptions\ProductNotFoundException;
use App\Repositories\Contracts\ProductRepositoryInterface;
use BugraBozkurt\InterServiceCommunication\Facades\Product;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @throws Throwable
     */
    public function getProductById(int $productId): ProductDTO
    {
        $cacheKey = CacheEnum::PRODUCT->getValue() . $productId;

        if ($cachedProduct = Cache::get($cacheKey)) {
            return ProductDTO::from($cachedProduct);
        }

        return $this->fetchProductFromService($productId);
    }

    /**
     * @throws ProductNotFoundException
     */
    private function fetchProductFromService(int $productId): ProductDTO
    {
        $response = Product::get("/api/v1/products/{$productId}");

        if (!$response->successful()) {
            throw new ProductNotFoundException();
        }

        $productData = $response->json('data');

        if (empty($productData['id'])) {
            throw new ProductNotFoundException();
        }

        $productData['name'] = $productData['name'] ?: ($productData['description'] ?? 'Ürün adı mevcut değil');

        return ProductDTO::from($productData);
    }
}
