<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alerrt;
use App\Models\Vehicle;

class AlerrtController extends Controller
{
    public function index()
    {
        $alerrts = Alerrt::with('vehicle')->get();
        return view('backend.alerrt.index', compact('alerrts'));
    }

    public function create()
    {

        $vehicles = Vehicle::all();
        return view('backend.alerrt.create', compact('vehicles'));
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
        Alerrt::create($request->all());

        return redirect()->route('alerrt.index')->with('success', 'Alert has been created successfully.');
    }

    public function edit($id)
    {

        $alerrt = Alerrt::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('backend.alerrt.edit', compact('alerrt', 'vehicles'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'kilometer' => 'required|integer',
            'servicing' => 'required|string',
            'status' => 'required|string',
        ]);


        $alerrt = Alerrt::findOrFail($id);
        $alerrt->update($request->all());

        return redirect()->route('alerrt.index')->with('success', 'Alert has been updated successfully.');
    }

    public function show($id)
    {
        $alerrt = Alerrt::findOrFail($id);
        return view('backend.alerrt.show', compact('alerrt'));
    }

    public function destroy(Alerrt $alerrt)
    {

        $alerrt->delete();
        return redirect()->route('alerrt.index')->with('success', 'Alert has been deleted successfully.');
    }
}
