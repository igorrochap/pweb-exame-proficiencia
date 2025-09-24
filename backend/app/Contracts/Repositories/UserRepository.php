<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface UserRepository
{
    public function create(array $attributes): User;

    public function findByEmail(string $email): ?User;
}
