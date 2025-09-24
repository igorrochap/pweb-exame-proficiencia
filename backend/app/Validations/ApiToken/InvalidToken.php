<?php

namespace App\Validations\ApiToken;

use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvalidToken extends TokenValidation
{
    public function handle(\Exception $exception): ?JsonResponse
    {
        if ($exception instanceof SignatureInvalidException || $exception instanceof \DomainException) {
            return response()->json(["message" => "Invalid authorization token"], Response::HTTP_UNAUTHORIZED);
        }
        return parent::handle($exception);
    }
}
