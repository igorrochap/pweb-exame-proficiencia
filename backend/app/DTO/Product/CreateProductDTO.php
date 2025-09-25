<?php

namespace App\DTO\Product;

use App\Http\Requests\Product\CreateProductRequest;
use App\Support\JwtWrapper;

readonly class CreateProductDTO
{
    public function __construct(
        public int $userID,
        public string $name,
        public int $price,
        public int $quantity,
        public array $categories,
    ) {}

    public static function fromRequest(CreateProductRequest $request): CreateProductDTO
    {
        return new self(
            JwtWrapper::getUserID($request->cookie('token')),
            $request->string('name'),
            $request->integer('price'),
            $request->integer('quantity'),
            $request->array('categories'),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userID,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
