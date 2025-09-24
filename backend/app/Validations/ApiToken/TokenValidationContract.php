<?php

namespace App\Validations\ApiToken;

use Illuminate\Http\JsonResponse;

interface TokenValidationContract
{
    public function add(TokenValidationContract $validation): TokenValidationContract;
    public function handle(\Exception $exception): ?JsonResponse;
}
