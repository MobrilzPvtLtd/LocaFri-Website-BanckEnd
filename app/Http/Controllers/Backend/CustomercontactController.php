<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customercontact;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\ContractIn;


use Session;

class CustomercontactController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('is_viewbooking', '!=', 0)
        ->where('is_confirm', '=', 0)
        ->with(['checkout'])
        ->orderBy('created_at', 'desc')
        ->get();
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

    public function show($id)
    {
        // $booking = Booking::findOrFail($id);
        $booking = Booking::with(['checkout','ContractIn','transaction'])->findOrFail($id); // Fetch related data

        return view('backend.customercontact.show', compact('booking'));
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

//     public function sendContractEmail(Request $request)
// {
//     $bookingId = $request->booking_id;
//     $checkout = Checkout::where('booking_id', $bookingId)->first();

//     if ($checkout) {
//         $email = $checkout->email;

//         Mail::to($email)->send(new MakeContract($checkout));

//         return response()->json(['status' => true, 'message' => 'Email sent successfully!']);
//     } else {
//         return response()->json(['status' => false, 'message' => 'Checkout not found.']);
//     }
// }






}
