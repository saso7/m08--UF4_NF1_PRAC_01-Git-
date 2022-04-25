<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orders;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrdersItems>
 */
class OrdersItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $orders = Orders::all();
        $products = Product::all();
        $product = $products->random();
        $order = $orders->random();
        $product_id = $product->id;
        $order_id = $order->id;
        return [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $this->faker->randomFloat(1, 0, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
