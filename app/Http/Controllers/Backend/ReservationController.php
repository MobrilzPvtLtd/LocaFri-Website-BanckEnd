<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Booking;

class ReservationController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('is_viewbooking', '!=', 1)->where('is_rejected', '!=', 1)->get();
        // dd($bookings);
        return view('backend.reservation.index', compact('bookings'));
    }

    public function is_viewbooking(Request $request)
    {
        $booking = Booking::where('id', $request->booking_id)->first();

        if ($booking) {
            $booking->is_viewbooking = 1;
            $booking->save();

            return response()->json($booking);
        }
    }

    public function is_rejected(Request $request)
    {
        $booking = Booking::where('id', $request->booking_id)->first();

        if ($booking) {
            $booking->is_rejected = 1;
            $booking->save();

            return response()->json($booking);
        }
    }

    public function is_contract(Request $request)
    {
        $booking = Booking::where('id', $request->booking_id)->first();

        if ($booking) {
            $booking->is_contract = 1;
            $booking->save();

            return response()->json($booking);
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
    public function show($id)
{
    $booking = Booking::findOrFail($id); // Fetch the booking by its ID
    return view('backend.reservation.show', compact('booking'));
}

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
