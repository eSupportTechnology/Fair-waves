<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop; 

class VendorShopController extends Controller
{

    public function index()
    {
        $vendorId = session('vendor_id');
        $shop = Shop::where('vendor_id', $vendorId)->first();

        return view('VendorDashboard.shop', compact('shop'));
    }


   public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_description' => 'required|string',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->back()->with('error', 'Vendor ID is missing.');
        }
        $shop = Shop::where('vendor_id', $vendorId)->first();

        $logoPath = $shop->shop_logo ?? null;

        if ($request->hasFile('shop_logo')) {
            $file = $request->file('shop_logo');
            $originalName = $file->getClientOriginalName();
            $logoPath = $file->storeAs('shop_logos', $originalName, 'public');
        }

        Shop::updateOrCreate(
            ['vendor_id' => $vendorId],
            [
                'shop_name' => $request->shop_name,
                'shop_description' => $request->shop_description,
                'shop_logo' => $logoPath,
            ]
        );

        return redirect()->route('vendor.shop')->with('success', 'Shop details saved successfully!');
    }

}
