<?php

namespace App\Repositories\Contracts;

use App\Data\ProductDTO;

interface ProductRepositoryInterface
{
    public function getProductById(int $productId): ?ProductDTO;
}
