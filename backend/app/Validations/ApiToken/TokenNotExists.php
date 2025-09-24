<?php

namespace App\Validations\ApiToken;

use App\Exceptions\TokenDoesntExistsException;
use App\Validations\ApiToken\TokenValidation;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TokenNotExists extends TokenValidation
{
    public function handle(\Exception $exception): ?JsonResponse
    {
        if ($exception instanceof TokenDoesntExistsException) {
            return response()->json(["message" => "Authorization token not found"], Response::HTTP_UNAUTHORIZED);
        }
        return parent::handle($exception);
    }
}
