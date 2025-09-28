<?php

namespace App\Http\Controllers\Product;

use App\Actions\Product\Movement\CreateMovement;
use App\DTO\Product\Movement\NewMovementDTO;
use App\Exceptions\Product\QuantityNotAllowedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Movement\NewMovementRequest;
use App\Support\JwtWrapper;
use Illuminate\Http\JsonResponse;

class MovementController extends Controller
{
    public function store(string $uuid, NewMovementRequest $request, CreateMovement $action): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        try {
            $movement = $action->handle(
                new NewMovementDTO($uuid, $request->string('type'), $request->integer('quantity')),
                $userID
            );

            return $this->created($movement);
        } catch (QuantityNotAllowedException $exception) {
            return $this->conflict($exception->getMessage());
        }
    }
}
