<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;

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
            'features' => 'required',
            'Dprice' => 'required',
            'wprice' => 'required',
            'mprice' => 'required',
            'available' => 'required|date_format:H:i', // Validate the available time
        ]);

        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalExtension();
                // $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('uploads'), $filename);
                $imagePaths[] = 'uploads/' . $filename;
            }
        }

        $currentDate = Carbon::now()->toDateString();
        $availableDatetime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $request->input('available'));

        $vehicleData = $request->except('image', 'featured', 'features', 'available');
        $vehicleData['image'] = serialize($imagePaths);
        $vehicleData['available_date'] = $availableDatetime;

        if (!empty($request->features)) {
            $vehicleData['features'] = json_encode($request->features);
        }

        $vehicleData['featured'] = $request->has('featured');
        Vehicle::create($vehicleData);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle has been created successfully.');
    }

    public function show()
    {
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $featuresArray = json_decode($vehicle->features, true);
        // foreach($features as $feature){
        //     $data_feature = $feature;
        //     // dd($data_feature);
        // }
        return view('backend.vehicle.edit', compact('vehicle','featuresArray'));
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
            'features' => 'required',
            'Dprice' => 'required',
            'wprice' => 'required',
            'mprice' => 'required',
            'available' => 'required|date_format:H:i',
        ]);

        $vehicle = Vehicle::findOrFail($id);

        $imagePaths = unserialize($vehicle->image);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('uploads'), $filename);
                $imagePaths[] = 'uploads/' . $filename;
            }
        }
        $currentDate = Carbon::now()->toDateString();
        $availableDatetime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $request->input('available'))->toDateTimeString();

        $vehicleData = $request->except('image', 'featured', 'features', 'available');
        $vehicleData['image'] = serialize($imagePaths);
        $vehicleData['available'] = $availableDatetime;

        if (!empty($request->features)) {
            $vehicleData['features'] = json_encode($request->features);
        }

        $vehicleData['featured'] = $request->has('featured');
        $vehicle->update($vehicleData);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle has been updated successfully.');
    }




    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }
}
