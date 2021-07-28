<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ConfigurationPlugin
 *
 * @property int $id
 * @property int $configuration_id
 * @property int $plugin_id
 * @property int $edition_id
 * @property-read \App\Models\Edition $edition
 * @property-read \App\Models\Plugin $plugin
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin whereConfigurationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin whereEditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigurationPlugin wherePluginId($value)
 * @mixin \Eloquent
 */
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
