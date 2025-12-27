<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Amenity extends Model {
    use HasUuids, HasTranslations;
    protected $fillable = ['group_id', 'internal_code', 'name', 'icon_provider', 'icon_name', 'applicable_contexts'];
    public array $translatable = ['name'];
    protected $casts = ['applicable_contexts' => 'array'];
    
    public function group() { return $this->belongsTo(AmenityGroup::class); }
    public function places() { return $this->belongsToMany(Place::class); }
}