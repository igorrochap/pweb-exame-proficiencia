<?php

namespace App\DTO\Auth;

class TokenDTO
{
    public function __construct(
        public string $access_token,
        public int $issued_at,
        public int $expiration,
    ) {}
}
