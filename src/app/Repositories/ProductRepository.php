<?php

namespace App\Repositories;

use App\Data\ProductDTO;
use App\Enums\CacheEnum;
use App\Exceptions\ProductNotFoundException;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProductById(int $productId): ?ProductDTO
    {
        //TODO cache'de bulunamadığı durumda product-service'den çekilecek
        $cachedProduct = Cache::get(CacheEnum::PRODUCT->getValue().$productId);

        throw_if(!$cachedProduct, new ProductNotFoundException());

        return ProductDTO::from($cachedProduct);

    }

}
