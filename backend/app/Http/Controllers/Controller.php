<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    protected function success(mixed $resource): JsonResponse
    {
        return response()->json($resource);
    }

    protected function created(Model $entity): JsonResponse
    {
        return response()->json($entity, Response::HTTP_CREATED);
    }

    protected function noContent(): JsonResponse
    {
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    protected function error(string $message): JsonResponse
    {
        return response()->json(['message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
