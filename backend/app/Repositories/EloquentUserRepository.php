<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\DTO\User\CreateUserDTO;
use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function createFromDTO(CreateUserDTO $dto): User
    {
        return User::query()->create($dto->toArray());
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }
}
