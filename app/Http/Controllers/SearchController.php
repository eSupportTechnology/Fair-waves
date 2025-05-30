<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('q');

            // Search products based on the query
            $products = Product::with('images') // Eager load images
                ->where('product_name', 'LIKE', '%' . $query . '%')
                ->orWhere('tags', 'LIKE', '%' . $query . '%')
                ->get();

            // Return JSON response with relevant data
            return response()->json($products);
        }
    }

    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('product_name', 'like', "%{$query}%")
            ->with(['images', 'category'])
            ->limit(10)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->product_name,
                    'image' => $product->images->first() ? asset('storage/app/public/' . $product->images->first()->image_path) : 'default.jpg',
                    'url' => url('/product-details/' . $product->product_id),
                ];
            });

        $categories = Product::where('product_name', 'like', "%{$query}%")
            ->with(['images', 'category'])
            ->limit(10)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->category?->name ?? 'Unnamed',
                    'url' => url('/shop?category_id=' . urlencode($product->category?->id)),
                ];
            })
            ->unique('name')
            ->values();




        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
