<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrderItems;
use App\Models\VendorWallet;
use App\Models\Vendor;

class VendorWalletController extends Controller
{

    public function index()
    {
        // Get the vendor_id from the session or authentication context
        $vendorId = session('vendor_id');
    
        // Fetch vendor's wallet
        $vendorWallet = VendorWallet::where('vendor_id', $vendorId)->first();
    
        // If the vendor doesn't have a wallet, create one with a balance of 0 and total_earnings of 0
        if (!$vendorWallet) {
            $vendorWallet = VendorWallet::create([
                'vendor_id' => $vendorId,
                'balance' => 0,           // Set initial balance to 0
                'total_earnings' => 0,    // Set initial total earnings to 0
            ]);
        }
    
        // Fetch customer order items for the vendor, filtered by vendor_id in the products table
        $orders = CustomerOrderItems::with('order', 'product')
            ->whereHas('product', function ($query) use ($vendorId) {
                $query->where('shop_id', function ($query) use ($vendorId) {
                    $query->select('id')
                          ->from('shops')
                          ->where('vendor_id', $vendorId);
                });
            })
            ->orderBy('created_at', 'desc') 
            ->paginate(10); 
    
        // Calculate the total earnings for the vendor
        $totalEarnings = $orders->sum(function ($orderItem) {
            $product = $orderItem->product;
    
            // Base commission (8%)
            $baseCommission = $orderItem->cost * 0.08;
    
            // Check if the product is an affiliate product and apply additional commission (considering quantity)
            $affiliateCommission = $product->is_affiliate ? $product->commission_price * $orderItem->quantity : 0;
    
            // Total commission
            $totalCommission = $baseCommission + $affiliateCommission;
    
            // Calculate vendor share
            return $orderItem->cost - $totalCommission;
        });
    
        // Update the vendor's wallet with the current balance and total earnings
        $vendorWallet->balance = $totalEarnings; // Current balance
        $vendorWallet->total_earnings = $totalEarnings; // total earnings
        $vendorWallet->save();
    
        return view('VendorDashboard.wallet', compact('vendorWallet', 'totalEarnings', 'orders'));
    }
    
    
    
    
}

