<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'content' => fake()->text(),
            'published' => true,
            'created_at' => fake()->dateTimeThisYear()
        ];
    }
}
