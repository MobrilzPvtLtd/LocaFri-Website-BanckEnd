<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Booking;
use Session;

class ReservationController extends Controller
{
    public function index()
    {
        $booking = session('booking', null);
        $bookings = Booking::all();
        return view('backend.reservation.index', compact('bookings', 'booking'));
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




    public function create()
    {
        return view('backend.reservation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'start' => 'required',
            'end' => 'required',
            'method' => 'required',
        ]);

        Reservation::create($request->post());

        return redirect()->route('reservation.index')->with('success', 'reservation has been created successfully.');
    }
    public function show() {}

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('backend.reservation.edit', compact('reservation'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'start' => 'required',
            'end' => 'required',
            'method' => 'required',
        ]);

        $reservations = Reservation::findOrFail($id);
        $reservations->update($request->all());

        return redirect()->route('reservation.index')->with('success', 'reservations has been updated successfully.');
    }

    // public function destroy(Booking $booking)
    // {
    //     dd($booking);
    //     $booking->delete();
    //     return redirect()->route('enquiry');
    // }
}
