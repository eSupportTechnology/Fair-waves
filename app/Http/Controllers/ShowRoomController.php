<?php

namespace App\Http\Controllers;

use App\Models\DealerProductLink;
use Illuminate\Http\Request;

class ShowRoomController extends Controller
{
    public function index()
    {
        // This method will return the showroom view
        return view('frontend.DealerShowroom.home.index');
    }

    public function productView($dealer_shop_name, $unique_code)
    {
        // Find the product link using the unique code
        $productLink = DealerProductLink::with('product', 'dealer')
            ->where('unique_code', $unique_code)
            ->firstOrFail();

        return view('frontend.DealerShowroom.product.productView', compact('productLink'));
    }
}
