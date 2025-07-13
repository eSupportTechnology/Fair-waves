<?php

namespace App\Http\Controllers;

use App\Models\DealerProductLink;
use App\Models\User;
use Illuminate\Http\Request;

class ShowRoomController extends Controller
{
    public function index($dealer_shop_name)
    {
        // Find the dealer by shop name
        $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
            $query->where('dealer_shop_name', $dealer_shop_name);
        })->where('role', 'dealer')->with('dealerProfile')->first();

        if (!$dealer) {
            abort(404, 'Showroom not found');
        }

        // Get all products for this dealer
        $dealerProducts = DealerProductLink::with([
            'product.images',
            'product.category',
            'product.brand',
            'product.variations'
        ])
        ->where('dealer_id', $dealer->id)
        ->paginate(12);

        return view('frontend.DealerShowroom.home.index', compact('dealer', 'dealerProducts'));
    }

    public function productView($dealer_shop_name, $unique_code)
    {
        // Find the product link using the unique code with all necessary relationships
        $productLink = DealerProductLink::with([
            'product.images',
            'product.variations',
            'product.reviews',
            'product.category',
            'product.brand',
            'dealer.dealerProfile'
        ])
            ->where('unique_code', $unique_code)
            ->firstOrFail();

        // Verify that the dealer shop name matches
        if ($productLink->dealer->dealerProfile->dealer_shop_name !== $dealer_shop_name) {
            abort(404, 'Product not found in this showroom');
        }

        // Get the dealer for header display
        $dealer = $productLink->dealer;

        return view('frontend.DealerShowroom.product.productView', compact('productLink', 'dealer'));
    }
}
