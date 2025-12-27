<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AmenityGroup extends Model {
    use HasUuids, HasTranslations;
    protected $fillable = ['internal_code', 'name', 'position', 'ui_style'];
    public array $translatable = ['name'];
    public function amenities() { return $this->hasMany(Amenity::class, 'group_id'); }
}