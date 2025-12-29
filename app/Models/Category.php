<?php

namespace App\Models;

use App\Contracts\SeoInterface;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Category
 *
 * @property-read string $id
 * @property-read string|null $slug
 * @property-read string|null $type
 * @property-read string|null $internal_code
 * @property-read string|null $schema_type
 * @property-read array|null $name
 * @property-read string|null $localized_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category where(string $column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category doesntHave(string $relation)
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Collection|Category[] all()
 * @method static self create(array $attributes = [])
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 *
 * @mixin \Eloquent
 */
class Category extends Model implements HasMedia, SeoInterface
{
    use HasFactory, HasSeo, HasTranslations, HasUuids, InteractsWithMedia, NodeTrait, Searchable, SoftDeletes {
        Searchable::usesSoftDelete insteadof NodeTrait;
    }

    public $keyType = 'string';
    public $incrementing = false;

    public $fillable = [
        'parent_id',
        'type',
        'internal_code',
        'is_active',
        'order_priority',
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_meta_description',
        'og_title',
        'og_description',
        'featured_image_alt',
        'icon_name',
        'color_theme',
        'schema_type',
        '_lft',
        '_rgt',
    ];

    public $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'slug' => 'array',
        'description' => 'array',
        'seo_title' => 'array',
        'seo_meta_description' => 'array',
        'og_title' => 'array',
        'og_description' => 'array',
        'featured_image_alt' => 'array',
    ];

    public array $translatable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_meta_description',
        'og_title',
        'og_description',
        'featured_image_alt',
    ];

    public $appends = ['localized_url'];

    /**
     * URL Hiérarchique Localisée (ex: /fr/activity/outdoor/trails/cycling)
     */
    public function localizedUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $ancestors = $this->getAncestors();
                $path = $ancestors->count() > 0
                    ? $ancestors->map(fn($a) => $a->getTranslation('slug', app()->getLocale()))
                                ->push($this->getTranslation('slug', app()->getLocale()))
                                ->implode('/')
                    : $this->getTranslation('slug', app()->getLocale());

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

    public function getSchemaMarkup(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->schema_type,
            'name' => $this->name,
            'url' => $this->localized_url,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('icon_svg')->singleFile();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order_priority');
    }

    /**
     * Scope pour catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour filtrer par type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
