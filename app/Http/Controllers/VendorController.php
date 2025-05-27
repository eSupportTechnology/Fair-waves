<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrderItems;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function indexx()
    {
        $location = request()->get('location');
        $vendors = Vendor::with('shop')
                        ->when($location, function ($query) use ($location) {
                            return $query->where('address', 'like', '%' . $location . '%');
                        })
                        ->paginate(15);
    
        $totalResults = $vendors->total(); 
    
        return view('frontend.vendor', compact('vendors', 'totalResults'));
    }
    



    
    public function showVendorDetails($vendorId)
    {
        // Fetch vendor and its related shop
        $vendornew = Vendor::with('shop')->find($vendorId);
        $categoryId = request()->get('category_id');
        
        $products = Product::with(['images', 'reviews' => function ($query) {
            $query->where('status', 'Published'); 
        }, 'shop'])
        ->where('shop_id', $vendornew->shop->id)
        ->when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->paginate(20);
  
        foreach ($products as $product) {
            $orderedQuantity = CustomerOrderItems::where('product_id', $product->id)->sum('quantity');
            $product->sold_quantity = $orderedQuantity;
            $product->total_quantity = $orderedQuantity + $product->quantity;
    
            // Calculate average rating and total reviews for only published reviews
            $product->average_rating = $product->reviews->avg('rating') ?? 0;
            $product->total_reviews = $product->reviews->count();
        }
    
        $categories = Category::all();
    
        return view('frontend.vendor-details', compact('vendornew', 'products', 'categories', 'categoryId'));
    }
    
    
    
    
    
}
