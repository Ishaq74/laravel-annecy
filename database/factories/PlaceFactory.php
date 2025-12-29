<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition(): array
    {
        return [
            'owner_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'name' => ['fr' => $this->faker->company, 'en' => $this->faker->company],
            'slug' => ['fr' => $this->faker->slug, 'en' => $this->faker->slug],
            'description' => ['fr' => $this->faker->paragraph, 'en' => $this->faker->paragraph],
            'short_description' => ['fr' => $this->faker->sentence, 'en' => $this->faker->sentence],
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'elevation' => $this->faker->randomFloat(2, 0, 3000),
            'address_full' => $this->faker->address,
            'city_name' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country_code' => $this->faker->countryCode,
            'is_verified' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'socials' => [],
            'opening_hours' => [],
            'seo_data' => [],
        ];
    }
}
