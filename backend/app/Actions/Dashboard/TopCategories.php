<?php

namespace App\Actions\Dashboard;

use App\Contracts\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class TopCategories
{
    public function __construct(
        private ProductRepository $repository
    ) {}

    public function handle(int $userID): Collection
    {
        $products = $this->repository->totalAmountPerCategory($userID);

        return $products->take(3);
    }
}
