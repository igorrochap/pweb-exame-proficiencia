<?php

namespace App\DTO\Product;

use App\Http\Requests\Product\UpdateProductRequest;

final readonly class UpdateProductDTO
{
    public function __construct(
        public string $name,
        public int $price,
        public array $categories,
    ) {}

    public static function fromRequest(UpdateProductRequest $request): UpdateProductDTO
    {
        return new self(
            $request->string('name'),
            $request->integer('price'),
            $request->input('categories'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
