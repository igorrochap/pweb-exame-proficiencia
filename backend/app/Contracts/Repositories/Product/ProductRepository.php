<?php

namespace App\Contracts\Repositories\Product;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product;

    public function listByUser(int $userID, ?string $name, bool $paginated = false): Collection|LengthAwarePaginator;

    public function findByUUID(string $uuid, int $userID): ?Product;

    public function updateFromDTO(Product $product, UpdateProductDTO $dto): Product;

    public function updateQuantity(Product $product, int $quantity): void;

    public function deleteByUuid(string $uuid, int $userID): void;
}
