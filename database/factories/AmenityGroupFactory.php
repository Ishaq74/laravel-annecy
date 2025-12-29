<?php

namespace Database\Factories;

use App\Models\AmenityGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityGroupFactory extends Factory
{
    protected $model = AmenityGroup::class;

    public function definition(): array
    {
        return [
            'internal_code' => $this->faker->unique()->bothify('GRP_##??'),
            'name' => ['fr' => $this->faker->word, 'en' => $this->faker->word],
            'position' => $this->faker->numberBetween(1, 100),
            'ui_style' => $this->faker->randomElement(['list', 'badges', 'icons']),
        ];
    }
}
