<?php

namespace App\Http\Controllers;

use App\Models\BusStops;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class BusStopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BusStops::all();
        return view('busStops.index', compact('busStops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $busStops = BusStops::all();
        return view('busStops.create', compact('busStops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        BusStops::create($request->all());

        return redirect()->route('busStops.index')
            ->with('success', 'Bus Stop created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(BusStops $busStops)
    {
        return view('busStops.show', compact('busStops'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusStops $busStops)
    {
        return view('busStops.edit', compact('busStops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusStops $busStops)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $busStops->update($request->all());

        return redirect()->route('busStops.index')
            ->with('success', 'Bus Stop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusStops $busStops)
    {
        $busStops->delete();

        return redirect()->route('busStops.index')
            ->with('success', 'Bus Stop deleted successfully.');
    }
}
