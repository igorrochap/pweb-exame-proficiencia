<?php

namespace App\Support;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final readonly class JwtWrapper
{
    public static function encode(array $payload): string
    {
        return JWT::encode($payload, config('jwt.key'), 'HS256');
    }

    public static function decode(string $token): \stdClass
    {
        $payload = JWT::decode($token, new Key(config('jwt.key'), 'HS256'));

        return $payload->sub;
    }

    public static function getUserID(string $token): int
    {
        $payload = self::decode($token);

        return $payload->id;
    }
}
