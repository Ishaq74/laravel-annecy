<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceGastronomy extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'cuisine_types' => 'array',        // Ex: ["Italien", "Pizza"]
        'dietary_types' => 'array',        // Ex: ["Vegan", "Sans Gluten"]
        'price_level' => 'integer',
        'avg_price_dish' => 'decimal:2',
        'has_terrace' => 'boolean',
        'has_takeaway' => 'boolean',
        'has_click_and_collect' => 'boolean',
        'has_delivery' => 'boolean',
        'michelin_stars' => 'integer',
        'gaultmillau_toques' => 'integer',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
