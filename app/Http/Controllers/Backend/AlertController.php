<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Vehicle;

class AlertController extends Controller
{
    public function index()
    {
        // Fetch alerts with status 'pending' and mark them as seen
        $alerts = Alert::with(['ContractOut.ContractIn', 'ContractOut.booking'])
            ->where('status', 'pending')  // Only include 'pending' status alerts
            ->select('alerts.*')
            ->get();

        // Mark all fetched alerts as seen
        Alert::whereIn('id', $alerts->pluck('id'))->update(['seen' => 1]);

        // Return alerts to the view
        return view('backend.alert.index', compact('alerts'));
    }


    public function create()
    {

        $vehicles = Vehicle::all();
        return view('backend.alert.create', compact('vehicles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'kilometer' => 'required|integer',
            'servicing' => 'required|string',
            'status' => 'required|string',
        ]);

        // Store the new alert
        Alert::create($request->all());

        return redirect()->route('alert.index')->with('success', 'Alert has been created successfully.');
    }

    public function edit($id)
    {

        $alert = Alert::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('backend.alert.edit', compact('alert', 'vehicles'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'kilometer' => 'required|integer',
            'servicing' => 'required|string',
            'status' => 'required|string',
        ]);


        $alert = Alert::findOrFail($id);
        $alert->update($request->all());

        return redirect()->route('alert.index')->with('success', 'Alert has been updated successfully.');
    }

    public function show($id)
    {
        $alert = Alert::findOrFail($id);
        return view('backend.alert.show', compact('alert'));
    }

    public function destroy(Alert $alert)
    {

        $alert->delete();
        return redirect()->route('alert.index')->with('success', 'Alert has been deleted successfully.');
    }
}
