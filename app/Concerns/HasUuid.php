<?php

namespace App\Concerns;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }
}
