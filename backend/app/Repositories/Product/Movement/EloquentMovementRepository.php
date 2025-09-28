<?php

namespace App\Repositories\Product\Movement;

use App\Contracts\Repositories\Product\Movement\MovementRepository;
use App\DTO\Product\Movement\PersistMovementDTO;
use App\Models\Product\Movement;

class EloquentMovementRepository implements MovementRepository
{
    public function createFromDTO(PersistMovementDTO $dto): Movement
    {
        return Movement::query()->create($dto->toArray());
    }
}
