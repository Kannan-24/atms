<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of routes.
     */
    public function index()
    {
        $routes = Route::paginate(10);
        return view('busroutes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new route.
     */
    public function create()
    {
        return view('busroutes.create');
    }

    /**
     * Store a newly created route in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'total_distance' => 'required|numeric',
        ]);

        Route::create($request->all());

        return redirect()->route('busroutes.index')->with('success', 'Route added successfully.');
    }

    /**
     * Display the specified route.
     */
    public function show(Route $busroute)
    {
        return view('busroutes.show', compact('busroute'));
    }

    /**
     * Show the form for editing the specified route.
     */
    public function edit(Route $busroute)
    {
        return view('busroutes.edit', compact('busroute'));
    }

    /**
     * Update the specified route in storage.
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'total_distance' => 'required|numeric',
        ]);

        $route->update($request->all());

        return redirect()->route('busroutes.index')->with('success', 'Route updated successfully.');
    }

    /**
     * Remove the specified route from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('busroutes.index')->with('success', 'Route deleted successfully.');
    }
}
