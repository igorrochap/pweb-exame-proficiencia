<?php

namespace App\ValueObjects;

use Illuminate\Support\Str;

readonly class UUID
{
    public function __construct(
        private string $value
    ) {}

    public static function create(): UUID
    {
        $uuid = Str::uuid7();

        return new self($uuid->toString());
    }

    public function get(): string
    {
        return $this->value;
    }
}
