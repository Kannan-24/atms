<?php

namespace App\Http\Controllers;

use App\Models\GpsLocation;
use Illuminate\Http\Request;

class GpsLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'reached_at' => 'required',
        ]);

        GpsLocation::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'reached_at' => $request->reached_at,
        ]);

        return response()->json([
            'message' => 'Location saved successfully',
            'status' => 'success',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(GpsLocation $gpsLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GpsLocation $gpsLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GpsLocation $gpsLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GpsLocation $gpsLocation)
    {
        //
    }
}
