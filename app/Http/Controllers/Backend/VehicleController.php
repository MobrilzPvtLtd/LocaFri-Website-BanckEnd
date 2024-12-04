<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        // 'body' => 'required',
        // 'seat' => 'required',
        // 'door' => 'required',
        'luggage' => 'required',
        'fuel' => 'required',
        // 'auth' => 'required',
        'trans' => 'required',
        'exterior' => 'required',
        'interior' => 'required',
        // 'features' => 'required|array',
        'Dprice' => 'required',
        'wprice' => 'required',
        'mprice' => 'required',
        'available' => 'required|date_format:H:i',
        // Validate the time format
    ]);

    $imagePaths = [];

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            $imagePath = $file->store('upload', 'public');
            $imagePaths[] = $imagePath;
        }
    }


    $currentDate = Carbon::now()->toDateString();
    $availableDatetime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $request->input('available'))->toDateTimeString();


    $vehicleData = $request->except('image', 'featured', 'features', 'available');

    if (!empty($imagePaths)) {
        $vehicleData['image'] = json_encode($imagePaths);
    }

    if (!empty($request->features)) {
        $vehicleData['features'] = json_encode($request->features);
    }

    $vehicleData['available_time'] = $availableDatetime;
    $vehicleData['featured'] = $request->has('featured');


    Vehicle::create($vehicleData);

    return redirect()->route('vehicle.index')->with('success', 'Vehicle has been created successfully.');
   }

   public function show($id)
{
    $vehicle = Vehicle::findOrFail($id);
    return view('backend.vehicle.show', compact('vehicle'));
}

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $featuresArray = json_decode($vehicle->features, true);
        // foreach($features as $feature){
        //     $data_feature = $feature;
        //     // dd($data_feature);
        // }
        return view('backend.vehicle.edit', compact('vehicle', 'featuresArray'));
    }

  public function update(Request $request, $id)
    {
        $request->validate([
            // 'name' => 'required',
            // 'model' => 'required',
            // 'type' => 'required',
            // 'desc' => 'required',
            // 'mitter' => 'required',
            // 'body' => 'required',
            // 'seat' => 'required',
            // 'door' => 'required',
            // 'luggage' => 'required',
            // 'fuel' => 'required',
            // 'auth' => 'required',
            // 'trans' => 'required',
            // 'exterior' => 'required',
            // 'interior' => 'required',
            // 'features' => 'array',
            // 'Dprice' => 'required',
            // 'wprice' => 'required',
            // 'mprice' => 'required',
            // 'available' => 'date_format:H:i', // Validate the time format
        ]);

        $vehicle = Vehicle::findOrFail($id);

        $oldImagePath = $vehicle->image;
        $imagePaths = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePath = $file->store('upload', 'public');
                $imagePaths[] = $imagePath;
            }
            if ($oldImagePath) {
                $oldImages = json_decode($oldImagePath, true);
                foreach ($oldImages as $image) {
                    Storage::disk('public')->delete($image); // Delete old images
                }
            }
        }
        // $currentDate = Carbon::now()->toDateString();
        // $availableDatetime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $request->input('available'))->toDateTimeString();

        // Prepare vehicle data for updating
        $vehicleData = $request->except('image', 'featured', 'features', 'available');

        if (!empty($imagePaths)) {
            $vehicleData['image'] = json_encode($imagePaths);
        }

        if (!empty($request->features)) {
            $vehicleData['features'] = json_encode($request->features);
        }

        // $vehicleData['available_time'] = $availableDatetime;
        $vehicleData['featured'] = $request->has('featured');

        // Update the vehicle record
        $vehicle->update($vehicleData);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle has been updated successfully.');
    }
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }
}
