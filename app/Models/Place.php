<?php
namespace App\Models;

use App\Contracts\SeoInterface;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Scout\Searchable;

class Place extends Model implements HasMedia, SeoInterface
{
    use HasUuids, HasTranslations, SoftDeletes, InteractsWithMedia, Searchable, HasSeo {
        Searchable::usesSoftDelete insteadof HasSeo;
    }

    protected $guarded = ['id']; // On protège juste l'ID, tout le reste est mass-assignable

    public array $translatable = ['name', 'slug', 'description', 'short_description'];

    protected $casts = [
        'socials' => 'array',
        'opening_hours' => 'array',
        'seo_data' => 'array',
        'latitude' => 'float', 'longitude' => 'float', 'elevation' => 'float',
        'is_verified' => 'boolean', 'is_featured' => 'boolean',
    ];

    // Relations Extensions
    public function gastronomy() { return $this->hasOne(PlaceGastronomy::class); }
    public function accommodation() { return $this->hasOne(PlaceAccommodation::class); }
    public function trail() { return $this->hasOne(PlaceTrail::class); }
    public function shop() { return $this->hasOne(PlaceShop::class); }
    public function venue() { return $this->hasOne(PlaceVenue::class); }

    // Relations Core
    public function amenities() { return $this->belongsToMany(Amenity::class)->withPivot('meta_value'); }
    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function category() { return $this->belongsTo(Category::class); }

    // Implémentation SEO et Searchable
    public function toSearchableArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'city' => $this->city_name,
            'type_trail' => $this->trail ? 'trail' : null,
            'type_hotel' => $this->accommodation ? 'hotel' : null,
        ];
    }
    
    public function getSchemaMarkup(): array { return []; } // À compléter selon besoin
    public function getFeaturedImageData(): array { return ['url' => '', 'alt' => '']; } // Stub
}