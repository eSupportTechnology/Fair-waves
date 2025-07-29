<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomerOrderItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function showbrands()
    {
        $brands = Brand::all();

        return view('AdminDashboard.brands_list', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'is_top_brand' => $request->has('is_top_brand'),
        ]);

        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug,' . $id,
            'image' => 'nullable|image|max:2048',
        ]);

        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $brand->image = $request->file('image')->store('brands', 'public');
        }

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->is_top_brand = $request->has('is_top_brand');
        $brand->save();

        return back()->with('success', 'Brand updated successfully!');
    }
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return back()->with('success', 'Brand image deleted successfully!');
    }

    public function edit($brandId)
    {

        $brand  = Brand::findOrFail($brandId);
        return view('AdminDashboard.edit_brand', compact('brand'));
    }

    public function getBrands()
    {
        $brands = Brand::select('name', 'slug', 'image', 'is_top_brand')->get();

        return response()->json($brands);
    }

    public function showBrandProducts($slug, Request $request)
    {
        // Verify the brand exists
        $selectedBrand = Brand::where('slug', $slug)->firstOrFail();
        
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
        
        // Force the selected brand to be included in brand filters
        $brandSlug = $request->input('brand_slug');
        $brandSlugs = $request->input('brand_slugs', []);
        
        // Always include the slug from URL as the primary brand filter
        if (!in_array($slug, $brandSlugs)) {
            $brandSlugs[] = $slug;
        }
        
        // If additional brand_slug is provided, add it to the array
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

    return view('frontend.shop', compact('products', 'categories', 'brands', 'minPrice', 'maxPrice', 'categoryIds', 'brandSlugs', 'subcategoryId', 'subsubcategoryId', 'color', 'rating', 'searchQuery', 'allCategoriesSelected', 'allBrandsSelected', 'isDealer', 'selectedBrand'));
    }

    public function ajaxBrandProducts(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = $brand->products();

        // Category filter
        if ($request->has('category_id') && $request->category_id != '') {
            $products->where('category_id', $request->category_id);
        }

        // Sorting
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case '1': // Price Low to High
                    $products->orderBy('normal_price', 'asc');
                    break;
                case '2': // Price High to Low
                    $products->orderBy('normal_price', 'desc');
                    break;
                case '4': // New Arrivals
                    $products->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $products->with('images')->get();

        return response()->json([
            'products' => $products,
        ]);
    }
}
