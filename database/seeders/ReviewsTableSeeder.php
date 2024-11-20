<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        Review::create([
            'product_id' => 1,  // Product ID is 1
            'user_id' => 3,  // Customer ID is 3
            'rating' => 5,
            'review' => 'Great shoes! Very comfortable.',
        ]);

        Review::create([
            'product_id' => 2,  // Product ID is 2
            'user_id' => 3,  // Customer ID is 3
            'rating' => 4,
            'review' => 'Nice quality shirt.',
        ]);
    }
}
