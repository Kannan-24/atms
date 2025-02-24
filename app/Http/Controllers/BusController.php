<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of buses.
     */
    public function index()
    {
        $buses = Bus::paginate(10);
        return view('buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new bus.
     */
    public function create()
    {
        return view('buses.create');
    }

    /**
     * Store a newly created bus in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255|unique:buses,number_plate',
            'no_of_seats' => 'required|integer',
        ]);

        Bus::create($request->all());

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    /**
     * Show the details of a specific bus.
     */
    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus'));
    }

    /**
     * Show the form for editing a bus.
     */
    public function edit(Bus $bus)
    {
        return view('buses.edit', compact('bus'));
    }

    /**
     * Update a bus's details.
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255|unique:buses,number_plate,' . $bus->id,
            'no_of_seats' => 'required|integer',
        ]);

        $bus->update($request->all());

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove a bus from the system.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}
