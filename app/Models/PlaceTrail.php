<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceTrail extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'distance_km' => 'decimal:2',
        'elevation_gain' => 'integer',
        'elevation_loss' => 'integer',
        'max_altitude' => 'integer',
        'min_altitude' => 'integer',
        'is_loop' => 'boolean',
        'is_guarded' => 'boolean',
        'has_lift_access' => 'boolean',
        'ground_types' => 'array', // Ex: {"terre": 80, "bitume": 20}
        'season_start' => 'date',
        'season_end' => 'date',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}