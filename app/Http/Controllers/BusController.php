<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\BusDriver;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::all();
        return view('buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::all();
        return view('buses.create')->with('drivers', $drivers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bus_number' => 'required|unique:buses',
            'starting_point' => 'required',
            'driver' => 'required|exists:drivers,id',
        ]);
        
        $bus=Bus::create([
            'bus_number' => $request->bus_number,
            'starting_point' => $request->starting_point,
        ]);

        BusDriver::create([
            'bus_id' => $bus->id,
            'driver_id' => $request->driver,
        ]);

        return redirect()->route('buses.index')
            ->with('success', 'Bus created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        $drivers = Driver::all();
        return view('buses.edit', compact('bus', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'bus_number' => 'required|unique:buses,bus_number,' . $bus->id,
            'starting_point' => 'required',
            'driver' => 'required|exists:drivers,id',
        ]);

        $bus->update([
            'bus_number' => $request->bus_number,
            'starting_point' => $request->starting_point,
        ]);

        BusDriver::where('bus_id', $bus->id)->update([
            'driver_id' => $request->driver,
        ]);

        return redirect()->route('buses.index')
            ->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        BusDriver::where('bus_id', $bus->id)->delete();
        $bus->delete();
        return redirect()->route('buses.index')
            ->with('success', 'Bus deleted successfully.');
    }
}
