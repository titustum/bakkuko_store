<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Women Clothing',
        ]);

        Category::create([
            'name' => 'Men Clothing',
        ]);

        Category::create([
            'name' => 'Women Footwear',
        ]);

        Category::create([
            'name' => 'Men Footwear',
        ]);
    }
}
