<?php

namespace App\Contracts\Repositories\Product\Movement;

use App\DTO\Product\Movement\PersistMovementDTO;
use App\Models\Product\Movement;
use Illuminate\Database\Eloquent\Collection;

interface MovementRepository
{
    public function createFromDTO(PersistMovementDTO $dto): Movement;

    public function listByUser(int $userID): Collection;
}
