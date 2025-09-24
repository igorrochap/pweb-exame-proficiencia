<?php

namespace App\Actions\Auth;

use App\Contracts\Repositories\UserRepository;
use App\DTO\Auth\TokenDTO;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

readonly class Authenticate
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function handle(string $email, string $password): ?TokenDTO
    {
        $user = $this->repository->findByEmail($email);
        if (is_null($user) || ! $this->passwordMatch($user, $password)) {
            return null;
        }

        return $this->generateToken($user);
    }

    private function passwordMatch(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    private function generateToken(User $user): TokenDTO
    {
        $issuedAt = time();
        $expiration = $issuedAt + (60 * 60);
        $payload = ['iat' => $issuedAt, 'exp' => $expiration, 'sub' => $user->uuid];
        $token = JWT::encode($payload, config('jwt.key'), 'HS256');

        return new TokenDTO($token, $issuedAt, $expiration);
    }
}
