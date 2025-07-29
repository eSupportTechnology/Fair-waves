<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CustomerOrderItems;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ShopPageController extends Controller
{
    public function index(Request $request)
{
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', 2000000);

    // Support search functionality
    $searchQuery = $request->input('search');

    // Support both single category_id and multiple category_ids
    $categoryId = $request->input('category_id');
    $categoryIds = $request->input('category_ids', []);

    // If single category_id is provided, add it to the array
    if ($categoryId && !in_array($categoryId, $categoryIds)) {
        $categoryIds[] = $categoryId;
    }

    // Support both single brand_slug and multiple brand_slugs
    $brandSlug = $request->input('brand_slug');
    $brandSlugs = $request->input('brand_slugs', []);

    // If single brand_slug is provided, add it to the array
    if ($brandSlug && !in_array($brandSlug, $brandSlugs)) {
        $brandSlugs[] = $brandSlug;
    }

    $subcategoryId = $request->input('subcategory_id');
    $subsubcategoryId = $request->input('subsubcategory_id');
    $color = $request->input('color');
    $rating = $request->input('rating'); // Get the rating filter from the request

    $query = Product::with(['images', 'variations', 'reviews' => function ($q) {
        $q->where('status', 'Published'); // Only include published reviews
    }, 'brand']);

    // Filter by search query
    if ($searchQuery) {
        $query->where(function ($q) use ($searchQuery) {
            $q->where('product_name', 'LIKE', '%' . $searchQuery . '%')
              ->orWhere('product_description', 'LIKE', '%' . $searchQuery . '%')
              ->orWhere('tags', 'LIKE', '%' . $searchQuery . '%');
        });
    }

    // Filter by main category (support multiple categories)
    if (!empty($categoryIds)) {
        $query->whereIn('category_id', $categoryIds);
    }

    // Filter by brand (support multiple brands)
    if (!empty($brandSlugs)) {
        $query->whereHas('brand', function ($q) use ($brandSlugs) {
            $q->whereIn('slug', $brandSlugs);
        });
    }

    // Filter by subcategory
    if ($subcategoryId) {
        $query->where('subcategory_id', $subcategoryId);
    }

    // Filter by sub-subcategory
    if ($subsubcategoryId) {
        $query->where('sub_subcategory_id', $subsubcategoryId);
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

    // Fetch brands with product count
    $brands = Brand::withCount('products')->get();

    // Check if all categories are selected
    $allCategoriesSelected = false;
    if (!empty($categoryIds)) {
        $totalCategories = $categories->count();
        $selectedCategories = count($categoryIds);
        $allCategoriesSelected = ($selectedCategories === $totalCategories);
    }

    // Check if all brands are selected
    $allBrandsSelected = false;
    if (!empty($brandSlugs)) {
        $totalBrands = $brands->count();
        $selectedBrands = count($brandSlugs);
        $allBrandsSelected = ($selectedBrands === $totalBrands);
    }

    // Get the quantity ordered and calculate ratings
    foreach ($products as $product) {
        $orderedQuantity = CustomerOrderItems::where('product_id', $product->id)->sum('quantity');
        $product->sold_quantity = $orderedQuantity;
        $product->total_quantity = $orderedQuantity + $product->quantity;

        // Calculate average rating and total reviews for only published reviews
        $product->average_rating = $product->reviews->where('status', 'Published')->avg('rating') ?? 0;
        $product->total_reviews = $product->reviews->where('status', 'Published')->count();
    }

    // Check if logged in user is a dealer
    $isDealer = Auth::check() && Auth::user()->role === 'dealer';

    return view('frontend.shop', compact('products', 'categories', 'brands', 'minPrice', 'maxPrice', 'categoryIds', 'brandSlugs', 'subcategoryId', 'subsubcategoryId', 'color', 'rating', 'searchQuery', 'allCategoriesSelected', 'allBrandsSelected', 'isDealer'));
}



    public function showProductDetails($product_id)
    {
        $product = Product::with(['images', 'variations', 'category','fee'])->where('product_id', $product_id)->first();
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
