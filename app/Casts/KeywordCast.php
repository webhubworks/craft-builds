<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class KeywordCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return explode('|', $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return is_array($value) ? implode('|', $value) : null;
    }
}
