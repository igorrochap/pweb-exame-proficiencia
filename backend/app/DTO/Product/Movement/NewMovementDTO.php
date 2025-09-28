<?php

namespace App\DTO\Product\Movement;

final readonly class NewMovementDTO
{
    public function __construct(
        public string $productUuid,
        public string $type,
        public int $quantity,
    ) {}
}
