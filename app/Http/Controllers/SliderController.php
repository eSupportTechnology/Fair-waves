<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider; // Assuming you have a Slider model
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // Show the page with all slider images
    public function index()
    {
        $sliders = Slider::all(); // Get all slider images from the database
        return view('AdminDashboard.slider', compact('sliders'));
    }

    // Store a new slider image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload the image
        $imagePath = $request->file('image')->store('slider_images', 'public');

        // Create a new Slider record
        $slider = new Slider();
        $slider->image = $imagePath;
        $slider->save();

        return back()->with('success', 'Image uploaded successfully!');
    }

    // Delete a slider image
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete the image file from storage
        if (Storage::exists('public/' . $slider->image)) {
            Storage::delete('public/' . $slider->image);
        }

        // Delete the record from the database
        $slider->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}
