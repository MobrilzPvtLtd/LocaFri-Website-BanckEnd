<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        // $reservations = Reservation::all();
        return view('backend.reservation.index');
    }
    public function create()
    {
        return view('backend.reservation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kilometer' => 'required',
            'fule' => 'required',
            'damage' => 'required',
        ]);

        Vehiclestatus::create($request->post());

        return redirect()->route('vehiclestatus.index')->with('success', 'vehiclestatus has been created successfully.');
    }
    public function show()
    {
    }

    public function edit($id)
    {
        $vehiclestatus = Vehiclestatus::findOrFail($id);
        return view('backend.vehiclestatus.edit', compact('vehiclestatus'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
           'kilometer' => 'required',
            'fule' => 'required',
            'damage' => 'required',
        ]);

        $vehiclestatus = Vehiclestatus::findOrFail($id);
        $vehiclestatus->update($request->all());

        return redirect()->route('vehiclestatus.index')->with('success', 'vehiclestatus has been updated successfully.');
    }

    public function destroy(Vehiclestatus $vehiclestatus)
    {
        $vehiclestatus->delete();
        return redirect()->route('vehiclestatus.index');
    }
}
