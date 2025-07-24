<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function updateAddress(Request $request)
    {

        $request->merge([
            'default' => $request->has('default') ? true : false,
        ]);

        // Validate the input
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'default' => 'boolean', // Now properly handling the boolean
            'address_id' => 'required|exists:addresses,id',
        ]);

        $address = Address::findOrFail($validatedData['address_id']);

        if ($validatedData['default']) {
            Address::where('user_id', $address->user_id)
                ->where('id', '!=', $address->id)
                ->update(['default' => 0]);

            $address->default = 1;
        } else {
            $address->default = 0;
        }

        $address->full_name = $validatedData['first_name'];
        $address->phone_num = $validatedData['phone'];
        $address->email = $validatedData['email'];
        $address->address = $validatedData['address'];
        $address->apartment = $validatedData['apartment'];
        $address->city = $validatedData['city'];
        $address->postal_code = $validatedData['postal_code'];

        if ($address->save()) {
        } else {
        }

        return redirect()->route('addresses')->with('status', 'Address updated successfully!');
    }

    public function storeAddress(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'default' => 'nullable|in:on,off',
        ]);

        $user = Auth::user();

        if (isset($validatedData['default']) && $validatedData['default'] === 'on') {
            Address::where('user_id', $user->id)
                ->where('default', true)
                ->update(['default' => false]);
        }

        $address = new Address();
        $address->user_id = $user->id;
        $address->full_name = $validatedData['first_name'];
        $address->phone_num = $validatedData['phone'];
        $address->email = $validatedData['email'];
        $address->address = $validatedData['address'];
        $address->apartment = $validatedData['apartment'];
        $address->city = $validatedData['city'];
        $address->postal_code = $validatedData['postal_code'];
        $address->default = isset($validatedData['default']) && $validatedData['default'] === 'on';

        $address->save();

        return redirect()->route('addresses')->with('status', 'Save is Successful');
    }


    public function showAddresses()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        return view('user_dashboard.addresses', compact('addresses'));
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $address = Address::where('id', $id)->where('user_id', $user->id)->first();

        if (!$address) {
            return redirect()->back()->with('error', 'Address not found or unauthorized access.');
        }

        $address->delete();
        return redirect()->route('addresses')->with('success', 'Address deleted successfully.');
    }
}
