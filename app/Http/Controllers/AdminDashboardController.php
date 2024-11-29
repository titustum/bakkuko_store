<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total orders, total products, and total revenue
        $totalOrders = Order::whereMonth('created_at', now()->month)->count();
        $totalProducts = Product::count();
        $totalRevenue = OrderItem::whereHas('order', function($query) {
            $query->whereMonth('created_at', now()->month);
        })->sum('price_at_time_of_order');

        // Get best selling items (products)
        $bestSellingItems = OrderItem::select('product_id', \DB::raw('sum(quantity) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        $bestSellingItemsLabels = $bestSellingItems->map(fn($item) => Product::find($item->product_id)->name)->toArray();
        $bestSellingItemsData = $bestSellingItems->map(fn($item) => $item->total_sales)->toArray();

        // Get items per category
        $categories = Category::all();
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryData = $categories->map(fn($category) => $category->products->count())->toArray();

        // Get recent orders
        $recentOrders = Order::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalOrders', 'totalProducts', 'totalRevenue',
            'bestSellingItemsLabels', 'bestSellingItemsData',
            'categoryLabels', 'categoryData', 'recentOrders'
        ));
    }
}
