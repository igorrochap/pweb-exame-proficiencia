<?php

namespace App\Repositories\Product\Movement;

use App\Contracts\Repositories\Product\Movement\MovementRepository;
use App\DTO\Product\Movement\PersistMovementDTO;
use App\Models\Product\Movement;
use Illuminate\Database\Eloquent\Collection;

class EloquentMovementRepository implements MovementRepository
{
    public function createFromDTO(PersistMovementDTO $dto): Movement
    {
        return Movement::query()->create($dto->toArray());
    }

    public function listByUser(int $userID): Collection
    {
        return Movement::query()
            ->select(['p.name as product', 'movements.type', 'movements.quantity', 'movements.created_at as date'])
            ->join('products as p', 'p.id', '=', 'movements.product_id')
            ->where('p.user_id', $userID)
            ->orderBy('movements.created_at', 'desc')
            ->get();
    }
}
