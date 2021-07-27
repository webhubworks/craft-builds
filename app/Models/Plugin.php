<?php

namespace App\Models;

use App\Casts\KeywordCast;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Laravel\Scout\Searchable;

/**
 * App\Models\Plugin
 *
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property string $handle
 * @property string $package_name
 * @property string|null $short_description
 * @property string $currency
 * @property string $developer_name
 * @property string|null $keywords
 * @property string $version
 * @property int|null $active_installs
 * @property string|null $icon_url
 * @property bool $abandoned
 * @property int|null $last_update_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @method static Builder|Plugin newModelQuery()
 * @method static Builder|Plugin newQuery()
 * @method static Builder|Plugin query()
 * @method static Builder|Plugin whereAbandoned($value)
 * @method static Builder|Plugin whereActiveInstalls($value)
 * @method static Builder|Plugin whereCreatedAt($value)
 * @method static Builder|Plugin whereCurrency($value)
 * @method static Builder|Plugin whereDeveloperName($value)
 * @method static Builder|Plugin whereHandle($value)
 * @method static Builder|Plugin whereIconUrl($value)
 * @method static Builder|Plugin whereId($value)
 * @method static Builder|Plugin whereKeywords($value)
 * @method static Builder|Plugin whereLastUpdateAt($value)
 * @method static Builder|Plugin whereName($value)
 * @method static Builder|Plugin wherePackageName($value)
 * @method static Builder|Plugin whereShortDescription($value)
 * @method static Builder|Plugin whereSourceId($value)
 * @method static Builder|Plugin whereUpdatedAt($value)
 * @method static Builder|Plugin whereVersion($value)
 * @mixin Eloquent
 * @property-read Collection|Configuration[] $configurations
 * @property-read int|null $configurations_count
 * @property-read Collection|\App\Models\Edition[] $editions
 * @property-read int|null $editions_count
 */
class Plugin extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'source_id',
        'name',
        'handle',
        'package_name',
        'short_description',
        'currency',
        'developer_name',
        'keywords',
        'version',
        'active_installs',
        'icon_url',
        'abandoned',
        'last_update_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'source_id' => 'integer',
        'keywords' => KeywordCast::class,
        'active_installs' => 'integer',
        'abandoned' => 'boolean',
        'last_update_at' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function configurations(): BelongsToMany
    {
        return $this->belongsToMany(Configuration::class);
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
    }

    public function getActiveInstallsAttribute($activeInstalls): string
    {
        return (new \NumberFormatter(\App::getLocale(), \NumberFormatter::DECIMAL))
            ->format($activeInstalls);
    }
}
