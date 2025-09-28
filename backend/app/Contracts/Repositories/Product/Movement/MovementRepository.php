<?php

namespace App\Contracts\Repositories\Product\Movement;

use App\DTO\Product\Movement\PersistMovementDTO;
use App\Models\Product\Movement;

interface MovementRepository
{
    public function createFromDTO(PersistMovementDTO $dto): Movement;
}
