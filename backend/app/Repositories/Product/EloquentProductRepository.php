<?php

namespace App\Repositories\Product;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\Models\Product\Product;

class EloquentProductRepository implements ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product
    {
        $product = Product::query()->create($dto->toArray());
        $product->categories()->sync($dto->categories);
        return $product;
    }
}
