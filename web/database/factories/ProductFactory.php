<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug'        => Str::slug(fake()->name()),
            'category_id' => \App\Models\Category::factory()->create()->id,
            'brand_id'    => \App\Models\Brand::factory()->create()->id,
            'price'       => 15000
        ];
    }
}
