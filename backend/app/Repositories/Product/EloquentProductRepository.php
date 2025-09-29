<?php

namespace App\Repositories\Product;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
            ->when(! is_null($name), fn (Builder $query) => $query->where('name', 'ilike', "%{$name}%"))
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

    public function deleteByUuid(string $uuid, int $userID): void
    {
        Product::query()->where('uuid', $uuid)->where('user_id', $userID)->delete();
    }

    public function totalAmountPerCategory(int $userID): Collection
    {
        return Category::query()
            ->select('categories.name', DB::raw('SUM(p.price * p.quantity) as amount'))
            ->join('products_categories as pc', 'categories.id', '=', 'pc.category_id')
            ->join('products as p', 'p.id', '=', 'pc.product_id')
            ->where('p.user_id', $userID)
            ->groupBy('categories.name')
            ->get();
    }
}
