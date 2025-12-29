<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'type' => 'default',
            'internal_code' => $this->faker->unique()->slug,
            'is_active' => true,
            'order_priority' => 1,
            'name' => ['fr' => $this->faker->word, 'en' => $this->faker->word],
            'slug' => ['fr' => $this->faker->slug, 'en' => $this->faker->slug],
            'description' => ['fr' => $this->faker->sentence, 'en' => $this->faker->sentence],
            'seo_title' => null,
            'seo_meta_description' => null,
            'og_title' => null,
            'og_description' => null,
            'featured_image_alt' => null,
            'icon_name' => null,
            'color_theme' => null,
            'schema_type' => 'CollectionPage',
        ];
    }
}
