<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\LastMovements;
use App\Actions\Dashboard\TopCategories;
use App\Actions\Dashboard\TotalAmount;
use App\Support\JwtWrapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function totalValueInStock(Request $request, TotalAmount $action): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $total = $action->handle($userID);

        return $this->success(['total' => $total]);
    }

    public function topCategories(Request $request, TopCategories $action): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $categories = $action->handle($userID);

        return $this->success($categories);
    }

    public function lastMovements(Request $request, LastMovements $action): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $lastMovements = $action->handle($userID);

        return $this->success($lastMovements);
    }
}
