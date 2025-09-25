<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepository $repository
    ) {
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->repository->createFromDTO(CreateProductDTO::fromRequest($request));
        return $this->created($product);
    }
}
