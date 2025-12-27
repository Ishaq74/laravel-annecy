<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceShop extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'brands' => 'array', // Ex: ["Nike", "Adidas"]
        'is_artisan' => 'boolean',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}