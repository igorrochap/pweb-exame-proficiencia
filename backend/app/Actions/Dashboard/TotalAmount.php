<?php

namespace App\Actions\Dashboard;

use App\Contracts\Repositories\Product\ProductRepository;

final readonly class TotalAmount
{
    public function __construct(
        private ProductRepository $repository
    ) {}

    public function handle(int $userID): int
    {
        $products = $this->repository->listByUser($userID, '');

        return (int) $products->reduce(function ($totalAmount, $product) {
            return $totalAmount + ($product->price * $product->quantity);
        });
    }
}
