<?php

namespace App\Models;

use App\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Money\Currency;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Build
 *
 * @property int $id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plugin[] $plugins
 * @property-read int|null $plugins_count
 * @method static \Illuminate\Database\Eloquent\Builder|Build newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build query()
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereUuid($value)
 * @mixin \Eloquent
 * @property Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereCurrency($value)
 */
class Build extends Model
{
    use HasFactory, HasUuid;

    public function plugins(): BelongsToMany
    {
        return $this->belongsToMany(Plugin::class)
            ->using(BuildPlugin::class)
            ->withPivot('edition_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Build $build) {
            static::addCraftAsPlugin($build);
        });
    }

    private static function addCraftAsPlugin(Build $build)
    {
        $craftCms = Plugin::whereHandle('cms')->with('editions')->first();
        $build->plugins()->attach(
            $craftCms, [
                'edition_id' => $craftCms->editions->firstWhere('handle', 'pro')->id,
            ]
        );
    }
}
