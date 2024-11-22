<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Add product to favorites
    public function store($productId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add favorites.');
        }

        $user = Auth::user();

        // Check if the product exists
        $product = Product::findOrFail($productId);

        // Check if the product is already in the user's favorites
        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            return back()->with('info', 'This product is already in your favorites.');
        }

        // Add product to favorites
        $user->favorites()->create([
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to favorites.');
    }

    // Remove product from favorites
    public function destroy($productId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to remove favorites.');
        }

        $user = Auth::user();

        // Find the favorite entry and delete it
        $favorite = $user->favorites()->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Product removed from favorites.');
        }

        return back()->with('error', 'Product not found in your favorites.');
    }

    // Display the user's favorites
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('product')->get();

        return view('favorites.index', compact('favorites'));
    }
}
