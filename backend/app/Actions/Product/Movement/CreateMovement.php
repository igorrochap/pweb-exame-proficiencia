<?php

namespace App\Actions\Product\Movement;

use App\Contracts\Repositories\Product\Movement\MovementRepository;
use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\Movement\NewMovementDTO;
use App\DTO\Product\Movement\PersistMovementDTO;
use App\Exceptions\Product\QuantityNotAllowedException;
use App\Models\Product\Movement;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;

final readonly class CreateMovement
{
    public function __construct(
        private ProductRepository $productRepository,
        private MovementRepository $movementRepository,
    ) {}

    public function handle(NewMovementDTO $dto, int $userID): Movement
    {
        return DB::transaction(function () use ($dto, $userID) {
            $product = $this->productRepository->findByUUID($dto->productUuid, $userID);
            $this->productRepository->updateQuantity($product, $this->calculateNewQuantity($product, $dto));

            return $this->movementRepository->createFromDTO(new PersistMovementDTO($product->id, $dto->type, $dto->quantity));
        });
    }

    /**
     * @throws QuantityNotAllowedException
     */
    private function calculateNewQuantity(Product $product, NewMovementDTO $dto): int
    {
        if ($dto->type === 'in' && $dto->quantity <= 0) {
            throw new QuantityNotAllowedException;
        }
        if ($dto->type === 'out' && $dto->quantity > $product->quantity) {
            throw new QuantityNotAllowedException;
        }
        if ($dto->type === 'in') {
            return $product->quantity + $dto->quantity;
        }

        return $product->quantity - $dto->quantity;
    }
}
