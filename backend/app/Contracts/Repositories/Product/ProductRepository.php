<?php

namespace App\Contracts\Repositories\Product;

use App\DTO\Product\CreateProductDTO;
use App\Models\Product\Product;

interface ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product;
}
