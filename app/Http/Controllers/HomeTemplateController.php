<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerOrderItems;
use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{

    public function index()
    {
        $categories = Category::with(['subcategories.subSubcategories'])->withCount('products')->get();

        // Fetch products with images and reviews
        $products = Product::with(['images', 'reviews' => function ($query) {
            $query->where('status', 'Published');
        }, 'shop'])->get();
        

        foreach ($products as $product) {
            $orderedQuantity = CustomerOrderItems::where('product_id', $product->id)->sum('quantity');
            $product->sold_quantity = $orderedQuantity;
            $product->total_quantity = $orderedQuantity + $product->quantity;
    
            // Calculate average rating and total reviews for only published reviews
            $product->average_rating = $product->reviews->where('status', 'Published')->avg('rating') ?? 0;
            $product->total_reviews = $product->reviews->where('status', 'Published')->count();
        }
    

        return view('frontend.home', compact('categories', 'products'));
    }
}
