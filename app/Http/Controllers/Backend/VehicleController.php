<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        $countlike = Like::where('like', 1);
        $countdislike = Like::where('like', 0);
        return view('backend.vehicle.index', compact('vehicles','countlike', 'countdislike'));
    }

    public function likeVehicle(Request $request, $vehicleId)
    {
        $like = Like::updateOrCreate(
            ['vehicle_id' => $vehicleId, 'user_id' => auth()->id()],
            ['like' => 1]
        );

        return redirect()->back();
    }

    public function dislikeVehicle(Request $request, $vehicleId)
    {
        $like = Like::updateOrCreate(
            ['vehicle_id' => $vehicleId, 'user_id' => auth()->id()],
            ['like' => 0]
        );

        return redirect()->back();
    }

    public function create()
    {
        return view('backend.vehicle.create');
    }
    public function store(Request $request) {
    $request->validate([
        'name' => 'required',
        'model' => 'required',
        'type' => 'required',
        // 'desc' => 'required',
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
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'available' => 'required|date_format:H:i',
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
    // $availableDatetime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $request->input('available'))->toDateTimeString();
    $vehicleData = $request->except('image', 'featured', 'features');
    if (!empty($imagePaths)) {
        $vehicleData['image'] = json_encode($imagePaths);
    }
    if (!empty($request->features)) {
        $vehicleData['features'] = json_encode($request->features);
    }
    // $vehicleData['available_time'] = $availableDatetime;
    $vehicleData['featured'] = $request->has('featured');
    Vehicle::create($vehicleData);
    return redirect()->route('vehicle.index')->with('success', 'Vehicle has been created successfully.');
 }
public function show($id) {
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
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $vehicle = Vehicle::findOrFail($id);

        $imagePaths = $vehicle->image ? json_decode($vehicle->image, true) : [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePath = $file->store('upload', 'public');
                $imagePaths[] = $imagePath;
            }
        }
        $vehicleData = $request->except('image', 'featured', 'features');

        if (!empty($imagePaths)) {
            $vehicleData['image'] = json_encode($imagePaths);
        }

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


    public function deleteImage(Request $request)
{
    $request->validate([
        'image' => 'required|string',
    ]);

    $imageName = $request->input('image');
    $vehicle = Vehicle::whereJsonContains('image', $imageName)->first();

    if ($vehicle) {
        Storage::disk('public')->delete($imageName);
        $images = json_decode($vehicle->image, true);
        $updatedImages = array_filter($images, fn($image) => $image !== $imageName);
        $vehicle->image = json_encode(array_values($updatedImages));
        $vehicle->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

public function incrementLikes($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->incrementLikes();

        return response()->json(['likes' => $vehicle->likes]);
    }




}
