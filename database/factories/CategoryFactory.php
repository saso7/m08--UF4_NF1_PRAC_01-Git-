<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// To use the ucfirst method we have to use this:
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // With this code we will create a random word not repeated with another one in the database
            "name" => Str::ucfirst($this->faker->unique()->word()),
        ];
    }
}
