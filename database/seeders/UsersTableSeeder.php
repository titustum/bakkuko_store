<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Creating users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bakkuko.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Seller User',
            'email' => 'seller@bakkuko.com',
            'password' => Hash::make('password123'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@bakkuko.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}
