<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
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
    public function definition()
    {
        $categories = Category::all();
        $category = $categories->random();
        $category_id = $category->id;
        return [
            "name" => Str::ucfirst($this->faker->unique()->sentence(3, true)),
            "price" => $this->faker->randomFloat(2, 0, 20),
            "amount" => $this->faker->randomDigit(0,50),
            "description" => Str::ucfirst($this->faker->text(255)),
            "file_path" => "public/images/imatgePc1.png",
            "category_id" => $category_id,
            // This way will be the same in one line
            // "category_id" => Category::all()->random()->id,
        ];
    }
}
