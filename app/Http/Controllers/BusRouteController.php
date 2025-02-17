<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use Illuminate\Http\Request;
use App\Models\Bus;

class BusRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $busRoutes = BusRoute::all();
        return view('busRoutes.index', compact('busRoutes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $buses = Bus::all();
        return view('busroutes.create', compact('buses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'bus_id' => 'required|exists:buses,id',
        ]);

        BusRoute::create($request->all());

        return redirect()->route('busRoutes.index')
            ->with('success', 'Bus Route created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusRoute $busRoute)
    {
        return view('busRoutes.show', compact('busRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusRoute $busRoute)
    {
        $buses = Bus::all();
        return view('busRoutes.edit', compact('busRoute', 'buses'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusRoute $busRoute)
    {
        $request->validate([
            'route_name' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'bus_id' => 'required|exists:buses,id',
        ]);

        $busRoute->update($request->all());

        return redirect()->route('busRoutes.index')
            ->with('success', 'Bus Route updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusRoute $busRoute)
    {
        $busRoute->delete();
         return redirect()->route('busRoutes.index')
            ->with('success', 'Bus Route deleted successfully.');
    }
}
