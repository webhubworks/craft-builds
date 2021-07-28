<?php

namespace App\Models;

use App\Facades\CurrencyConverter;
use Cknow\Money\Money;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Edition
 *
 * @property int $id
 * @property int $source_id
 * @property int $plugin_id
 * @property string $name
 * @property string $handle
 * @property int|null $price
 * @property int|null $renewal_price
 * @property array|null $features
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Edition newModelQuery()
 * @method static Builder|Edition newQuery()
 * @method static Builder|Edition query()
 * @method static Builder|Edition whereCreatedAt($value)
 * @method static Builder|Edition whereFeatures($value)
 * @method static Builder|Edition whereHandle($value)
 * @method static Builder|Edition whereId($value)
 * @method static Builder|Edition whereName($value)
 * @method static Builder|Edition wherePluginId($value)
 * @method static Builder|Edition wherePrice($value)
 * @method static Builder|Edition whereRenewalPrice($value)
 * @method static Builder|Edition whereSourceId($value)
 * @method static Builder|Edition whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Plugin $plugin
 * @property-read int|null $raw_price
 * @property-read int|null $raw_renewal_price
 */
class Edition extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'source_id' => 'integer',
        'features' => 'array',
        'price' => 'integer',
        'renewal_price' => 'integer',
    ];

    protected $fillable = [
        'source_id',
        'plugin_id',
        'name',
        'handle',
        'price',
        'renewal_price',
        'features',
    ];

    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class);
    }

    public function getRawPriceAttribute(): ?int
    {
        return $this->attributes['price'] ? (int) $this->attributes['price'] : null;
    }

    public function getPriceAttribute($price): ?string
    {
        if (!$price) {
            return null;
        }

        return CurrencyConverter::convert(
            Money::USD($price)
        )->format();
    }

    public function getRawRenewalPriceAttribute($renewalPrice): ?int
    {
        return $this->attributes['renewal_price'] ? (int) $this->attributes['renewal_price'] : null;
    }

    public function getRenewalPriceAttribute($renewalPrice): ?string
    {
        if (!$renewalPrice) {
            return null;
        }

        return CurrencyConverter::convert(
            Money::USD($renewalPrice)
        )->format();
    }
}
