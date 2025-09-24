<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepository $repository
    ) {
    }

    public function index(): JsonResponse
    {
        $categories = $this->repository->list();
        return $this->success($categories);
    }
}
