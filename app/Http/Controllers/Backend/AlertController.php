<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();
        return view('backend.alert.index', compact('alerts'));
    }

    public function create()
    {
        return view('backend.alert.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'plates' => 'required',
            'brakes' => 'required',
        ]);

        Alert::create($request->post());

        return redirect()->route('alert.index')->with('success', 'alert has been created successfully.');
    }
    public function show()
    {
    }

    public function edit($id)
    {
        $alert = Alert::findOrFail($id);
        return view('backend.alert.edit', compact('alert'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'service' => 'required',
            'plates' => 'required',
            'brakes' => 'required',
        ]);

        $alert = Alert::findOrFail($id);
        $alert->update($request->all());

        return redirect()->route('alert.index')->with('success', 'Alert has been updated successfully.');
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();
        return redirect()->route('alert.index');
    }
}
