<?php

namespace App\Casts;

use App\ValueObjects\UUID;
use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class UuidCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value ? (new UUID($value))->get() : null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value instanceof UUID) {
            return $value->get();
        }
        if (is_string($value)) {
            return (new UUID($value))->get();
        }
        throw new InvalidArgumentException("The field [{$key}] must be an string or an instance of UUID.]");
    }
}
