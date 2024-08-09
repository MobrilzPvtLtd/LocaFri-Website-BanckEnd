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
        $bookings = Booking::all();
        return view('backend.reservation.index', compact('bookings'));
    }

    public function accept(Request $request)
    {
        dd($request);
        $bookings = Booking::find($request->bookingId);
        if ($bookings) {

            $bookings->status = 'accepted';
            $bookings->save();

            Session::flash('success', 'Your booking is done.');

            return redirect()->route('reservation.index')->with('bookings', $bookings);
        } else {
            return redirect()->route('reservation.index')->with('error', 'Reservation not found.');
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
    public function show()
    {
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

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservation.index');
    }
}
