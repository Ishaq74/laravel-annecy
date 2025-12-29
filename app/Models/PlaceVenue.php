<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceVenue extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'capacity_total' => 'integer',
        'capacity_seated' => 'integer',
        'is_public_entity' => 'boolean', // Mairie, État, etc.
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
