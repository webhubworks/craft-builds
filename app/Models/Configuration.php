<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plugin[] $plugins
 * @property-read int|null $plugins_count
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUuid($value)
 * @mixin \Eloquent
 */
class Configuration extends Model
{
    use HasFactory;

    public function plugins(): BelongsToMany
    {
        return $this->belongsToMany(Plugin::class)->withPivot('edition_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Configuration $configuration) {
            $configuration->setAttribute('uuid', Uuid::uuid4());
        });

        static::created(function(Configuration $configuration) {
            $craftCms = Plugin::whereHandle('cms')->with('editions')->first();
            $configuration->plugins()->attach(
                $craftCms, [
                    'edition_id' => $craftCms->editions->firstWhere('handle', 'pro')->id,
                ]
            );
        });
    }
}
