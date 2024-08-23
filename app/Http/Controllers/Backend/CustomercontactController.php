<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customercontact;
use App\Models\Booking;
use Session;

class CustomercontactController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('is_viewbooking', '!=', 0)->get();
        // dd($bookings);
        return view('backend.customercontact.index',compact('bookings'));
    }
    public function create()
    {
        return view('backend.customercontact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'massage' => 'required',
        ]);

        Customercontact::create($request->post());

        return redirect()->route('customercontact.index')->with('success', 'customercontact has been created successfully.');
    }
    public function show()
    {
    }

    public function edit($id)
    {
        $customer = Customercontact::findOrFail($id);
        return view('backend.customercontact.edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'massage' => 'required',
        ]);

        $customer = Customercontact::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customercontact.index')->with('success', 'reservations has been updated successfully.');
    }

    public function destroy(Customercontact $customercontact)
    {
        $customercontact->delete();
        return redirect()->route('customercontact.index');
    }

    public function accept(Request $request)
    {
        $booking = Booking::find($request->booking_id);

        if ($booking) {
            $booking->status = 'accepted';
            $booking->save();

            // Set the booking in the session
            session(['booking' => $booking]);

            // session()->flash('booking', $booking);
            session()->flash('message', 'Your booking has been accepted.');

            // Return JSON response for AJAX request
            return response()->json(['status' => true, 'data' => $booking]);
        } else {
            return response()->json(['status' => false, 'message' => 'Booking not found.']);
        }
    }
}
