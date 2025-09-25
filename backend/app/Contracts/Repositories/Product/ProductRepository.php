<?php

namespace App\Contracts\Repositories\Product;

use App\DTO\Product\CreateProductDTO;
use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepository
{
    public function createFromDTO(CreateProductDTO $dto): Product;

    public function listByUser(int $userID, bool $paginated = false): Collection|LengthAwarePaginator;
}
