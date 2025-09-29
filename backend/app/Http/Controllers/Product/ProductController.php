<?php

namespace App\Http\Controllers\Product;

use App\Contracts\Repositories\Product\ProductRepository;
use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
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
        $products = $this->repository->listByUser($userID, $request->string('name'), true);

        return $this->success($products);
    }

    public function show(string $uuid, Request $request): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $product = $this->repository->findByUUID($uuid, $userID);
        if (is_null($product)) {
            return $this->notFound('Product not found');
        }

        return $this->success($product->makeHidden('id'));
    }

    public function update(UpdateProductRequest $request, string $uuid): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $product = $this->repository->findByUUID($uuid, $userID);
        if (is_null($product)) {
            return $this->notFound('Product not found');
        }
        $product = $this->repository->updateFromDTO($product, UpdateProductDTO::fromRequest($request));

        return $this->success($product);
    }

    public function delete(string $uuid, Request $request): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $this->repository->deleteByUUID($uuid, $userID);

        return $this->noContent();
    }
}
