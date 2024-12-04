<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function save(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required |email',
            'address_first' => 'required',
            'address_last' => 'required | address',
            'zipcode' => 'required | zipcode',
            'city' => 'required | city',
        ]);

        $checkout = new Checkout();

        $checkout->first_name = $validatedData['first_name'];
        $checkout->last_name = $validatedData['last_name'];
        $checkout->email = $validatedData['email'];
        $checkout->address_first = $validatedData['address_first'];
        $checkout->address_last = $validatedData['address_last'];
        $checkout->zipcode = $validatedData['zipcode'];
        $checkout->city = $validatedData['city'];
        $checkout->save();

        return redirect()->back()->with('success', 'Data saved successfully!');
    }
}
