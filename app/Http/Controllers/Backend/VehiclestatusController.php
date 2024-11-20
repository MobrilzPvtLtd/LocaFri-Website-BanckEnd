<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiclestatus;
use App\Models\Vehicle;

class VehiclestatusController extends Controller
{
    public function index()
{
    $vehiclestatus = Vehiclestatus::all();
    return view('backend.vehiclestatus.index', compact('vehiclestatus'));
}

    public function create()
    {
        $vehicles = Vehicle::all(); // Get all vehicles
        return view('backend.vehiclestatus.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id', // Ensure vehicle_id exists
            'kilometer' => 'required|numeric',
            'fule' => 'required|numeric',
            'damage' => 'required|string',
        ]);

        // Retrieve the vehicle name using the vehicle_id
        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle_name = $vehicle ? $vehicle->name : '';

        // Create the record with vehicle_name
        Vehiclestatus::create([
            'vehicle_id' => $request->vehicle_id,
            'vehicle_name' => $vehicle_name, // Store the vehicle name
            'kilometer' => $request->kilometer,
            'fule' => $request->fule,
            'damage' => $request->damage,
        ]);

        return redirect()->route('vehiclestatus.index')->with('success', 'Vehiclestatus has been created successfully.');
    }

    public function show($id)
    {
        $vehiclestatus = Vehiclestatus::findOrFail($id);
        return view('backend.vehiclestatus.show', compact('vehiclestatus'));
    }

    public function edit($id)
    {
        $vehiclestatus = Vehiclestatus::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('backend.vehiclestatus.edit', compact('vehiclestatus', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'kilometer' => 'required|numeric',
            'fule' => 'required|numeric',
            'damage' => 'required|string',
        ]);

        // Retrieve the vehicle name based on the updated vehicle_id
        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle_name = $vehicle ? $vehicle->name : '';

        // Find and update the vehicle status record
        $vehiclestatus = Vehiclestatus::findOrFail($id);
        $vehiclestatus->update([
            'vehicle_id' => $request->vehicle_id,
            'vehicle_name' => $vehicle_name, // Update vehicle name
            'kilometer' => $request->kilometer,
            'fule' => $request->fule,
            'damage' => $request->damage,
        ]);

        return redirect()->route('vehiclestatus.index')->with('success', 'Vehiclestatus has been updated successfully.');
    }

    public function destroy($id)
    {
        $vehiclestatus = Vehiclestatus::findOrFail($id);
        $vehiclestatus->delete();

        return redirect()->route('vehiclestatus.index')->with('success', 'Vehiclestatus has been deleted successfully.');
    }
}


