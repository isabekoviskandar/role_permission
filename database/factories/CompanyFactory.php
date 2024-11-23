<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'user_id' =>fake()->numberBetween(1,10),
          'name'=>fake()->name(),
          'phone_number'=>fake()->phoneNumber(),
          'is_active'=>fake()->boolean(40)  
        ];
    }
}
