<?php

namespace App\Models;

use App\Contracts\SeoInterface;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Scout\Searchable;

class Category extends Model implements HasMedia, SeoInterface
{
    // Résolution du conflit de traits : On utilise Searchable::usesSoftDelete à la place de celle de NodeTrait
    use HasUuids, HasTranslations, NodeTrait, SoftDeletes, InteractsWithMedia, Searchable, HasSeo {
        Searchable::usesSoftDelete insteadof NodeTrait;
    }

    protected $fillable = [
        'parent_id', 'type', 'internal_code', 'is_active', 'order_priority',
        'name', 'slug', 'description', 'seo_title', 'seo_meta_description',
        'og_title', 'og_description', 'featured_image_alt', 'icon_name', 'color_theme', 'schema_type'
    ];

    public array $translatable = [
        'name', 'slug', 'description', 'seo_title', 'seo_meta_description', 
        'og_title', 'og_description', 'featured_image_alt'
    ];

    /**
     * URL Hiérarchique Localisée (ex: /fr/activity/outdoor/trails/cycling)
     */
    protected function localizedUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $ancestors = $this->getAncestors();
                $path = $ancestors->count() > 0 
                    ? $ancestors->map(fn($a) => $a->slug)->push($this->slug)->implode('/')
                    : $this->slug;
                    
                return url(app()->getLocale() . '/' . str($this->type)->plural() . '/' . $path);
            }
        );
    }

    /**
     * Indexation Meilisearch
     */
    public function toSearchableArray(): array 
    {
        return [
            'id' => $this->id,
            'internal_code' => $this->internal_code,
            'name' => $this->getTranslations('name'),
            'type' => $this->type,
        ];
    }

    public function getSchemaMarkup(): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->schema_type,
            'name' => $this->name,
            'url' => $this->localized_url,
        ];
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('icon_svg')->singleFile();
    }

    public function parent(): BelongsTo { return $this->belongsTo(Category::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(Category::class, 'parent_id')->orderBy('order_priority'); }
}