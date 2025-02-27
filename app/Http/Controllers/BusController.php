<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusDriver;
use App\Models\Driver;
use App\Models\Faculty;
use App\Models\BusIncharge;
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
        $bus->load('facultyIncharge.faculty');
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

    /**
     * Show the form for assigning a driver to a bus.
     */
    public function assignDriverForm(Bus $bus)
    {
        // Get drivers who are either not assigned or have an expired valid_to date
        $assignedDriverIds = BusDriver::whereNull('valid_to')
        ->orWhere('valid_to', '>=', now()) // Drivers still valid
            ->pluck('driver_id')
            ->toArray();

        // Fetch drivers who are not in the assigned list OR their validity has expired
        $drivers = Driver::whereNotIn('id', $assignedDriverIds)->get();

        return view('buses.assigndriver', compact('bus', 'drivers'));
    }


    /**
     * Assign a driver to a bus.
     */
    public function assignDriver(Request $request, Bus $bus)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
        ]);

        // Check if the driver is currently assigned and still valid
        $existingAssignment = BusDriver::where('driver_id', $request->driver_id)
            ->where(function ($query) {
                $query->whereNull('valid_to')
                ->orWhere('valid_to', '>=', now());
            })
            ->first();

        if ($existingAssignment) {
            return redirect()->route('buses.index')->with('error', 'This driver is still assigned to another bus.');
        }

        // Assign driver to bus
        BusDriver::create([
            'bus_id' => $bus->id,
            'driver_id' => $request->driver_id,
            'valid_to' => null, // Set as null initially, validity can be updated later
        ]);

        return redirect()->route('buses.show', $bus->id)->with('success', 'Driver assigned successfully.');
    }

    /**
     * Update the validity of a driver assigned to a bus.
     */
    public function updateDriverValidity(Request $request, BusDriver $busDriver)
    {
        $request->validate([
            'valid_to' => 'required|date',
        ]);

        $busDriver->update([
            'valid_to' => $request->valid_to,
        ]);

        return redirect()->route('buses.show', $busDriver->bus_id)->with('success', 'Driver validity updated successfully.');
    }

    /**
     * Remove a driver assigned to a bus.
     */
    public function removeDriver($busDriverId)
    {
        $busDriver = BusDriver::find($busDriverId);

        if ($busDriver) {
            $busDriver->delete(); // Remove the record
            return redirect()->route('buses.show', $busDriver->bus_id)->with('success', 'Driver removed successfully.');
        }

        return redirect()->back()->with('error', 'Driver not found.');
    }



    public function assignFacultyForm(Bus $bus)
    {
        // Get faculties who are NOT assigned as a bus in-charge
        $assignedFacultyIds = BusIncharge::pluck('faculty_id')->toArray();
        $faculties = Faculty::whereNotIn('id', $assignedFacultyIds)->get();

        $bus->load('facultyIncharge.faculty');
        return view('buses.assignfaculty', compact('bus', 'faculties'));
    }

    public function assignFaculty(Request $request, Bus $bus)
    {
        // Check if the bus already has a faculty in charge
        if ($bus->facultyIncharge) {
            return back()->with('error', 'This bus already has a faculty in charge.');
        }

        // Proceed with faculty assignment
        BusIncharge::create([
            'bus_id' => $bus->id,
            'faculty_id' => $request->faculty_id
        ]);

        return redirect()->route('buses.show', $bus->id)->with('success', 'Faculty assigned successfully.');
    }

    public function removeFacultyIncharge($facultyInchargeId)
    {
        $facultyIncharge = BusIncharge::find($facultyInchargeId);

        if ($facultyIncharge) {
            $facultyIncharge->delete(); // Remove the record
            return redirect()->route('buses.show', $facultyIncharge->bus_id)
                ->with('success', 'Faculty Incharge removed successfully.');
        }

        return redirect()->back()->with('error', 'Faculty Incharge not found.');
    }


}
