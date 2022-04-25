<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
// Importem aquesta classe per poder encryptar el pass automaticament generat
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory([
            "name" => "guillem",
            "email" => "guillem.lorente@inslapineda.com",
            "password" => Hash::make("sasoriuchiha7"), 
        ])->create()->roles()->attach(1);
        User::factory([
            "name" => "client1",
            "email" => "client1@gmail.com",
            "password" => Hash::make("sasoriuchiha7"), 
        ])->create()->roles()->attach(2);
        // $user->roles()->attach(1);
    }
}
