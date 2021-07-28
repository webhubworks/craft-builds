<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ConfigurationPlugin extends Pivot
{
    protected $with = ['edition'];

    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class);
    }
}
