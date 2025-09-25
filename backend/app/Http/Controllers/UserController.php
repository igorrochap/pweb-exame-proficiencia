<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserRepository;
use App\DTO\User\CreateUserDTO;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $repository,
    ) {
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $newUser = $this->repository->createFromDTO(CreateUserDTO::fromRequest($request));

        return $this->created($newUser);
    }
}
