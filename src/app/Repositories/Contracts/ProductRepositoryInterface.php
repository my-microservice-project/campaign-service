<?php

namespace App\Repositories\Contracts;

use App\Data\Product\ProductDTO;

interface ProductRepositoryInterface
{
    public function getProductById(int $productId): ?ProductDTO;
}
