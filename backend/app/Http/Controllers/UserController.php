<?php

namespace App\Http\Controllers;

use App\Actions\User\Signup;
use App\DTO\User\CreateUserDTO;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(CreateUserRequest $request, Signup $action): JsonResponse
    {
        $newUser = $action->handle(CreateUserDTO::fromRequest($request));

        return $this->created($newUser);
    }
}
