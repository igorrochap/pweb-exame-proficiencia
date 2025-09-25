<?php

namespace App\Repositories\Product;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product
    {
        $product = Product::query()->create($dto->toArray());
        $product->categories()->sync($dto->categories);

        return $product;
    }

    public function listByUser(int $userID, bool $paginated = false): Collection|LengthAwarePaginator
    {
        $query = Product::query()
            ->select(['uuid', 'name', 'price', 'quantity'])
            ->where('user_id', $userID);
        if ($paginated) {
            return $query->paginate();
        }

        return $query->get();
    }
}
