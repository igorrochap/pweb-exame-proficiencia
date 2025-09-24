<?php

namespace App\Validations\ApiToken;

use App\Validations\ApiToken\TokenValidation;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExpiredToken extends TokenValidation
{
    public function handle(\Exception $exception): ?JsonResponse
    {
        if ($exception instanceof ExpiredException) {
            return response()->json(['message' => 'Expired token'], Response::HTTP_UNAUTHORIZED);
        }
        return parent::handle($exception);
    }
}
