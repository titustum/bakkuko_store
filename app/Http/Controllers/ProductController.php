<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all featured products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all products with their associated category
        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Display a specific product.
     *
     * @param  int  $productId
     * @return \Illuminate\View\View
     */
    public function show($productId)
    {
        // Fetch the product by ID with its associated category
        $product = Product::with('category')->findOrFail($productId);

        return view('products.show', compact('product'));
    }

    // Show the product creation form
    public function create()
    {
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('products.create', compact('categories'));
    }

    // Store the newly created product
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'fit' => 'nullable|string|max:255',
            'shoe_type' => 'nullable|in:sneakers,boots,sandals,formal,other',
            'is_available' => 'nullable|boolean',
        ]);

        // Handle the image upload (if any)
        $image_url = null;
        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url')->store('products', 'public');
        }

        // Create the product
        Product::create([
            // 'seller_id' => auth()->id(),
            'seller_id' => 2,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_url' => $image_url,
            'brand' => $request->brand,
            'color' => $request->color,
            'material' => $request->material,
            'size' => $request->size,
            'fit' => $request->fit,
            'shoe_type' => $request->shoe_type,
            'is_available' => $request->is_available ?? true, // Default to true if not provided
        ]);

        return redirect()->route('products.index')->with('success', 'Product uploaded successfully!');
    }

}
