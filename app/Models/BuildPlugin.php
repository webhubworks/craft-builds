<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ConfigurationPlugin
 *
 * @property int $id
 * @property int $build_id
 * @property int $plugin_id
 * @property int $edition_id
 * @property-read \App\Models\Edition $edition
 * @property-read \App\Models\Plugin $plugin
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin whereConfigurationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin whereEditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildPlugin wherePluginId($value)
 * @mixin \Eloquent
 */
class BuildPlugin extends Pivot
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
