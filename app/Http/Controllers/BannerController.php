<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner; // Assuming you will create a Banner model
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Show all banner images
    public function index()
    {
        $banners = Banner::all(); // Fetch all banners from the database
        return view('AdminDashboard.banners', compact('banners'));
    }

    // Store a new banner image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Validating image type and size
        ]);

        // Upload the banner image
        $imagePath = $request->file('image')->store('banners', 'public');

        // Create a new banner record in the database
        $banner = new Banner();
        $banner->image = $imagePath;
        $banner->save();

        return back()->with('success', 'Banner image uploaded successfully!');
    }

    // Delete a banner image
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete the image from storage
        if (Storage::exists('public/' . $banner->image)) {
            Storage::delete('public/' . $banner->image);
        }

        // Delete the banner record from the database
        $banner->delete();

        return back()->with('success', 'Banner image deleted successfully!');
    }

    // Download a banner image
    public function download($id)
    {
        $banner = Banner::findOrFail($id);

        // Return the image for download
        return response()->download(storage_path('app/public/' . $banner->image));
    }
}
