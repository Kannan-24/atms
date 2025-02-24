<?php

namespace App\Http\Controllers;

use App\Models\Stop;
use Illuminate\Http\Request;

class StopController extends Controller
{
    /**
     * Display a listing of stops.
     */
    public function index()
    {
        $stops = Stop::paginate(6);
        return view('stops.index', compact('stops'));
    }

    /**
     * Show the form for creating a new stop.
     */
    public function create()
    {
        return view('stops.create');
    }

    /**
     * Store a newly created stop in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stop_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        Stop::create($request->all());

        return redirect()->route('stops.index')->with('success', 'Stop added successfully.');
    }

    /**
     * Display the specified stop.
     */
    public function show(Stop $stop)
    {
        return view('stops.show', compact('stop'));
    }

    /**
     * Show the form for editing a stop.
     */
    public function edit(Stop $stop)
    {
        return view('stops.edit', compact('stop'));
    }

    /**
     * Update a stop's details.
     */
    public function update(Request $request, Stop $stop)
    {
        $request->validate([
            'stop_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        $stop->update($request->all());

        return redirect()->route('stops.index')->with('success', 'Stop updated successfully.');
    }

    /**
     * Remove a stop from the system.
     */
    public function destroy(Stop $stop)
    {
        $stop->delete();
        return redirect()->route('stops.index')->with('success', 'Stop deleted successfully.');
    }
}
