<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @mixin Eloquent
 * @property int $id
 * @property int $source_id
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property string $icon_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereIconUrl($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereSourceId($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plugin[] $plugins
 * @property-read int|null $plugins_count
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'title',
        'description',
        'slug',
        'icon_url',
    ];

    protected $casts = [
        'id' => 'integer',
        'source_id' => 'integer',
    ];

    public function plugins(): HasMany
    {
        return $this->hasMany(Plugin::class);
    }
}
