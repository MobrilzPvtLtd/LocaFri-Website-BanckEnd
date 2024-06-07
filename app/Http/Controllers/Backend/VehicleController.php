<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('backend.vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        return view('backend.vehicle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'type' => 'required',
            'desc' => 'required',
            'mitter' => 'required',
            'body' => 'required',
            'seat' => 'required',
            'door' => 'required',
            'luggage' => 'required',
            'fuel' => 'required',
            'auth' => 'required',
            'trans' => 'required',
            'exterior' => 'required',
            'interior' => 'required',
        ]);
        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('uploads'), $filename);
                $imagePaths[] = 'uploads/' . $filename;
            }
        }
        $vehicleData = $request->except('image', 'featured');
        $vehicleData['image'] = serialize($imagePaths);
        $vehicleData['featured'] = $request->has('featured');
        Vehicle::create($vehicleData);

        return redirect()->route('vehicle.index')->with('success', 'vehicle has been created successfully.');
    }
    public function show()
    {
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('backend.vehicle.edit', compact('vehicle'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'type' => 'required',
            'desc' => 'required',
            'mitter' => 'required',
            'body' => 'required',
            'seat' => 'required',
            'door' => 'required',
            'luggage' => 'required',
            'fuel' => 'required',
            'auth' => 'required',
            'trans' => 'required',
            'exterior' => 'required',
            'interior' => 'required',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $imagePaths = [];

        // Attempt to unserialize existing images
        try {
            $imagePaths = unserialize($vehicle->image);
        } catch (\Exception $e) {
            $imagePaths = [];
        }

        // Ensure $imagePaths is an array
        if (!is_array($imagePaths)) {
            $imagePaths = [];
        }

        // Handle new image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('uploads'), $filename);
                $imagePaths[] = 'uploads/' . $filename;
            }
        }

        $vehicleData = $request->except('image', 'featured');
        $vehicleData['image'] = serialize($imagePaths);
        $vehicleData['featured'] = $request->has('featured');

        try {
            $vehicle->update($vehicleData);
        } catch (\Exception $e) {
            // Handle the error (log it if necessary)
            return redirect()->back()->with('error', 'There was an error updating the vehicle: ' . $e->getMessage());
        }

        return redirect()->route('vehicle.index')->with('success', 'Vehicle has been updated successfully.');
    }



    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }
}
