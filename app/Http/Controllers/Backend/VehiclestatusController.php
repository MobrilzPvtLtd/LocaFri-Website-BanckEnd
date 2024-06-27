<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiclestatus;

class VehiclestatusController extends Controller
{
    public function index()
    {
        $vehiclestatus = Vehiclestatus::all();
        return view('backend.vehiclestatus.index',compact('vehiclestatus'));
    }
    public function create()
    {
        return view('backend.vehiclestatus.create');
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
