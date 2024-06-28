<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('backend.reservation.index',compact('reservations'));
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
