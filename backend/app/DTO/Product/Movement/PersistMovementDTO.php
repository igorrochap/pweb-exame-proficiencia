<?php

namespace App\DTO\Product\Movement;

final readonly class PersistMovementDTO
{
    public function __construct(
        public int $productID,
        public string $type,
        public int $quantity,
    ) {}

    public function toArray(): array
    {
        return [
            'product_id' => $this->productID,
            'type' => $this->type,
            'quantity' => $this->quantity,
        ];
    }
}
