<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use App\Models\CustomerOrder;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorReportController extends Controller
{
    

    public function orderReport(Request $request){
        $vendor_id = session('vendor_id');
        $query = CustomerOrder::query();

        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }

        if ($request->filled('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }

        $orders = $query->whereHas('items.product', function ($query) use ($vendor_id) {
            $query->where('shop_id', function ($query) use ($vendor_id) {
                $query->select('shop_id')
                    ->from('shops')
                    ->where('vendor_id', $vendor_id)
                    ->limit(1);
            });
        })
        ->latest()
        ->paginate(10);
        return view('VendorDashboard.Reports.order_report',compact('orders'));
    }

    public function productReport(){
        $vendorId = session('vendor_id'); 
        $shop = Shop::where('vendor_id', $vendorId)->first();
        
        if (!$shop) {
            return redirect()->back()->with('error', 'Shop not found for the vendor.');
        }
        $products = Product::with(['images', 'category'])
            ->where('shop_id', $shop->id)->get();
        return view('VendorDashboard.Reports.product_report',compact('products'));
    }


}
