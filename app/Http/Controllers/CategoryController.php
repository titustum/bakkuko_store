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

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'image_url' => 'nullable|url',  // Optional image URL
        ]);

        // Create new category in database
        Category::create([
            'name' => $request->name,
            'image_url' => $request->image_url,
        ]);

        // Redirect to a page (e.g., categories.index) with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }
}
