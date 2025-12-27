<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceAccommodation extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'star_rating' => 'integer',
        'is_palace' => 'boolean',
        'total_units' => 'integer',
        'total_beds' => 'integer',
        'max_group_size' => 'integer',
        'reception_24h' => 'boolean',
        // On ne caste pas check_in/out en datetime car on veut juste l'heure "15:00" string
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}