<?php

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityFactory extends Factory
{
    protected $model = Amenity::class;

    public function definition(): array
    {
        return [
            'group_id' => AmenityGroup::factory(),
            'internal_code' => $this->faker->unique()->bothify('AMN_##??'),
            'name' => ['fr' => $this->faker->word, 'en' => $this->faker->word],
            'icon_provider' => 'heroicon',
            'icon_name' => $this->faker->word,
            'applicable_contexts' => ['global'],
        ];
    }
}
