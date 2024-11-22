<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // Validate the review data
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Create the review
        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = auth()->id() ?? 2; // Assuming you want to associate the review with the logged-in user
        $review->product_id = $product->id;
        $review->save();

        // Redirect back to the product page with a success message
        // return redirect()->route('products.show', $product->id)->with('success', 'Review submitted successfully!');
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
