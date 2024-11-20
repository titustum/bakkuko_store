<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')->get();
        return view('welcome', compact('categories', 'products'));
    }
}
