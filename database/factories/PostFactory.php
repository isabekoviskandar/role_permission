<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->numberBetween(0, 599),
            'image' => 'product_images/image.jpg',
            'count' => fake()->numberBetween(0, 1000),
            'premium' => fake()->boolean(40),
        ];
    }
    
}
