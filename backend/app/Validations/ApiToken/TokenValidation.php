<?php

namespace App\Validations\ApiToken;

use Illuminate\Http\JsonResponse;

abstract class TokenValidation implements TokenValidationContract
{
    private TokenValidationContract $next;

    public function add(TokenValidationContract $validation): TokenValidationContract
    {
        $this->next = $validation;
        return $validation;
    }

    public function handle(\Exception $exception): ?JsonResponse
    {
        if (isset($this->next)) {
            return $this->next->handle($exception);
        }
        return null;
    }
}
