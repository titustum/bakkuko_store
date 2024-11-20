<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'seller_id' => 2,  // Assuming the seller ID is 2
            'name' => 'South African Origin shoes',
            'description' => 'High-quality shoes made from the finest leather.',
            'price' => 40.00,
            'category_id' => 4,  // Men Footwear
            'image_url' => 'HeritageGreenProductShot5_2000x.webp',
        ]);

        Product::create([
            'seller_id' => 2,
            'name' => 'White Quality Men Polo Shirt',
            'description' => 'A stylish and comfortable polo shirt.',
            'price' => 39.00,
            'category_id' => 2,  // Men Clothing
            'image_url' => '871-shirt4.jpg',
        ]);

        Product::create([
            'seller_id' => 2,
            'name' => 'African Women Quality Linen Dress',
            'description' => 'Elegant and breathable linen dress for women.',
            'price' => 123.00,
            'category_id' => 1,  // Women Clothing
            'image_url' => '774-African-wax-print-dress-10.webp',
        ]);
    }
}
