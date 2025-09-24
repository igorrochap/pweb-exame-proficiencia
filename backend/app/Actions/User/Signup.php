<?php

namespace App\Actions\User;

use App\Contracts\Repositories\UserRepository;
use App\DTO\User\CreateUserDTO;
use App\Models\User;
use App\ValueObjects\UUID;

readonly class Signup
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function handle(CreateUserDTO $dto): User
    {
        $uuid = UUID::create();

        return $this->repository->create([...$dto->toArray(), 'uuid' => $uuid]);
    }
}
