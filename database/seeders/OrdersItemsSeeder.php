<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrdersItems;

class OrdersItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // OrdersItems::factory()->count(10)->create();

        // OrdersItems::factory([
        //     'order_id' => 2,
        //     "product_id" => 1,
        //     "quantity" => 1,
        //     "created_at" => now(),
        //     "updated_at" => now(),
        // ])->create();
    }
}
