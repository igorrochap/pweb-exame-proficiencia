<?php

namespace App\Actions\Dashboard;

use App\Contracts\Repositories\Product\Movement\MovementRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class LastMovements
{
    public function __construct(
        private MovementRepository $repository
    ) {}

    public function handle(int $userID): Collection
    {
        $lastMovements = $this->repository->listByUser($userID);

        return $lastMovements->take(5);
    }
}
