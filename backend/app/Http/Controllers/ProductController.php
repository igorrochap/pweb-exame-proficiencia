<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\Http\Requests\Product\CreateProductRequest;
use App\Support\JwtWrapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepository $repository
    ) {}

    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->repository->createFromDTO(CreateProductDTO::fromRequest($request));

        return $this->created($product);
    }

    public function index(Request $request): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $products = $this->repository->listByUser($userID, true);

        return $this->success($products);
    }
}
