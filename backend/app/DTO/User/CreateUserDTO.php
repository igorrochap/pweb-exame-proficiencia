<?php

namespace App\DTO\User;

use App\Http\Requests\CreateUserRequest;

readonly class CreateUserDTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
    ) {}

    public static function fromRequest(CreateUserRequest $request): CreateUserDTO
    {
        return new self(
            $request->string('name'),
            $request->string('email'),
            $request->string('password'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
