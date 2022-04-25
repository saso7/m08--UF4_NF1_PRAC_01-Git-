<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $users = User::all();
        $user = $users->random();
        $user_id = $user->id;
        return [
            'users_id' => $user_id,
            'total_price' => $this->faker->randomFloat(20, 0, 800),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
