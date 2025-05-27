<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\RaffleTicket;
use Illuminate\Support\Facades\Session;

class AffiliateProductController extends Controller
{
    

    public function showAdCenter(Request $request)
    {
        $categoryName = $request->get('category', 'all');
        $customerId = Session::get('customer_id');
    
        // Retrieve user's tracking IDs
        $trackingIds = RaffleTicket::where('user_id', $customerId)->get();
    
        // Set the default "Pending" tracking ID or the first one if no "Pending" status exists
        $defaultTrackingId = $trackingIds->where('status', 'Pending')->first();
        if (!$defaultTrackingId && $trackingIds->count() > 0) {
            $defaultTrackingId = $trackingIds->first();
            $defaultTrackingId->status = 'Pending';
            $defaultTrackingId->save();
        }
    
        // Initialize the product query for Hot Deals
        $productQuery = Product::with(['images', 'category', 'subcategory', 'subSubcategory'])
            ->where('is_affiliate', 1);
    
        // Apply category filter if specified
        if ($categoryName !== 'all') {
            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                $productQuery->where('category_id', $category->id);
            }
        }
    
        // Retrieve products for Hot Deals
        $hotDeals = $productQuery->get();
    
        // Set a commission percentage threshold for High Commission products
        $commissionThreshold = 8;
    
        // Initialize the query for High Commission products
        $highCommissionQuery = Product::with(['images', 'category', 'subcategory', 'subSubcategory'])
            ->where('commission_percentage', '>', $commissionThreshold)
            ->where('is_affiliate', 1);
    
        // Apply the same category filter to High Commission products if specified
        if ($categoryName !== 'all' && isset($category)) {
            $highCommissionQuery->where('category_id', $category->id);
        }
    
        // Retrieve High Commission products
        $higherCommissionDeals = $highCommissionQuery->get();
    
        // Retrieve all categories for the category filter dropdown
        $categories = Category::with('subcategories.subSubcategories')->get();
    
        return view('AffiliateDashBoard.adcenter', compact('hotDeals', 'higherCommissionDeals', 'categories', 'defaultTrackingId'));
    }
    

    
}
