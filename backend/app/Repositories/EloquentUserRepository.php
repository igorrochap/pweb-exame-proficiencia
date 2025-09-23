<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function create(array $attributes): User
    {
        return User::query()->create($attributes);
    }
}
