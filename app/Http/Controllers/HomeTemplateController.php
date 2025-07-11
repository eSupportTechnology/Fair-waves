<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerOrderItems;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeTemplateController extends Controller
{

    public function index()
    {
        $categories = Category::with(['subcategories.subSubcategories'])->withCount('products')->get();

        // Check if logged in user is a dealer
        $isDealer = Auth::check() && Auth::user()->role === 'dealer';

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

        // Filter products based on tags
        $topSellingProducts = $products->filter(function ($product) {
            return strpos($product->tags, 'Top Selling') !== false;
        });

        $Onlineexclusive = $products->filter(function ($product) {
            return strpos($product->tags, 'Online Exclusive') !== false;
        });

        $belowrs = $products->filter(function ($product) {
            return strpos($product->tags, 'Below') !== false;
        });

        // Fetch the banner and slider images
        $banners = Banner::all(); // Assuming you have a Banner model
        $sliders = Slider::all(); // Assuming you have a Slider model


        return view('frontend.home', compact('categories', 'products' ,'topSellingProducts', 'Onlineexclusive', 'belowrs', 'banners', 'sliders', 'isDealer'));
    }
}
