<?php

namespace App\Repositories\Product;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product
    {
        $product = Product::query()->create($dto->toArray());
        $product->categories()->sync($dto->categories);

        return $product;
    }

    public function listByUser(int $userID, ?string $name, bool $paginated = false): Collection|LengthAwarePaginator
    {
        $query = Product::query()
            ->select(['uuid', 'name', 'price', 'quantity'])
            ->where('user_id', $userID)
            ->when(!is_null($name), fn (Builder $query) => $query->where('name', 'ilike', "%{$name}%"))
            ->orderBy('name');
        if ($paginated) {
            return $query->paginate();
        }

        return $query->get();
    }

    public function findByUUID(string $uuid, int $userID): ?Product
    {
        return Product::query()
            ->with('categories:id,name')
            ->select(['id', 'uuid', 'name', 'price', 'quantity'])
            ->where('uuid', $uuid)
            ->where('user_id', $userID)
            ->first();
    }

    public function updateFromDTO(Product $product, UpdateProductDTO $dto): Product
    {
        $product->update($dto->toArray());
        $product->categories()->sync($dto->categories);
        $product->refresh();

        return $product;
    }

    public function updateQuantity(Product $product, int $quantity): void
    {
        $product->update(['quantity' => $quantity]);
    }
}
