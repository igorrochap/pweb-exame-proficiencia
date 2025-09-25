<?php

namespace App\Contracts\Repositories;

use App\DTO\User\CreateUserDTO;
use App\Models\User;

interface UserRepository
{
    public function createFromDTO(CreateUserDTO $dto): User;

    public function findByEmail(string $email): ?User;
}
