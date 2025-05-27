<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomerOrderItems;
use App\Models\Review;

class ShopPageController extends Controller
{
    public function index(Request $request)
{
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', 20000);
    $categoryId = $request->input('category_id');
    $subcategoryId = $request->input('subcategory_id');
    $subsubcategoryId = $request->input('subsubcategory_id');
    $color = $request->input('color');
    $rating = $request->input('rating'); // Get the rating filter from the request

    $query = Product::with(['images', 'variations', 'reviews' => function ($q) {
        $q->where('status', 'Published'); // Only include published reviews
    }]);

    // Filter by main category
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    // Filter by subcategory
    if ($subcategoryId) {
        $query->where('subcategory_id', $subcategoryId);
    }

    // Filter by sub-subcategory
    if ($subsubcategoryId) {
        $query->where('subsubcategory_id', $subsubcategoryId);
    }

    // Filter by color
    if ($color) {
        $query->whereHas('variations', function ($q) use ($color) {
            $q->where('type', 'color')->where('hex_value', $color);
        });
    }

    // Filter by rating
    if ($rating) {
        $query->whereHas('reviews', function ($q) use ($rating) {
            $q->where('status', 'Published')->where('rating', '>=', $rating); // Filter only published reviews
        });
    }

    // Filter by price
    $products = $query->whereBetween('normal_price', [$minPrice, $maxPrice])->paginate(20);

    // Fetch categories with product count
    $categories = Category::withCount('products')->get();

    // Get the quantity ordered and calculate ratings
    foreach ($products as $product) {
        $orderedQuantity = CustomerOrderItems::where('product_id', $product->id)->sum('quantity');
        $product->sold_quantity = $orderedQuantity;
        $product->total_quantity = $orderedQuantity + $product->quantity;

        // Calculate average rating and total reviews for only published reviews
        $product->average_rating = $product->reviews->where('status', 'Published')->avg('rating') ?? 0;
        $product->total_reviews = $product->reviews->where('status', 'Published')->count();
    }

    return view('frontend.shop', compact('products', 'categories', 'minPrice', 'maxPrice', 'categoryId', 'subcategoryId', 'subsubcategoryId', 'color', 'rating'));
}



    public function showProductDetails($product_id)
    {
        $product = Product::with(['images', 'variations', 'category'])->where('product_id', $product_id)->first();
        if (!$product) {
            abort(404);
        }

        // Fetch similar products in the same category, excluding the current product
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product_id)
            ->with(['images', 'variations'])
            ->take(10)
            ->get();

        $reviews = Review::where('product_id', $product->id)
            ->where('status', 'Published')
            ->with('reviewer')
            ->get();


        // Calculate average rating
        $averageRating = $reviews->avg('rating');

        // Calculate rating counts
        $ratingCounts = $reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });

        // Total reviews
        $totalReviews = $reviews->count();

        // Ensure all rating levels (1-5) exist
        $ratingCounts = collect([1, 2, 3, 4, 5])->mapWithKeys(function ($rating) use ($ratingCounts) {
            return [$rating => $ratingCounts->get($rating, 0)];
        });

        return view('frontend.product-details', compact(
            'product',
            'similarProducts',                   
            'reviews',
            'averageRating',
            'ratingCounts',
            'totalReviews'
        ));
    }
}
