<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all categories with the count of associated products
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the products in a specific category.
     *
     * @param  int  $categoryId
     * @return \Illuminate\View\View
     */
    public function show($categoryId)
    {
        // Fetch the category with its associated products
        $category = Category::with('products')->findOrFail($categoryId);

        return view('categories.show', compact('category'));
    }
}
