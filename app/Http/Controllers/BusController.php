<?php

namespace App\Http\Controllers;

use App\Mail\BusArrived;
use App\Models\Attendance;
use App\Models\Bus;
use App\Models\BusDriver;
use App\Models\Driver;
use App\Models\Faculty;
use App\Models\BusIncharge;
use App\Models\BusLocation;
use App\Models\BusRoute;
use App\Models\Route;
use App\Models\RouteStop;
use App\Models\Stop;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Update the location of a bus.
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'bus_id' => 'required|exists:buses,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driver = Driver::find($request->driver_id);
        $bus = Bus::find($request->bus_id);

        if (!$driver || !$bus) {
            return response()->json(['error' => 'Driver or bus not found.'], 404);
        }

        try {
            BusLocation::create([
                'bus_id' => $bus->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // Find the nearest stop and send mail (BusDriver)
            $nearestStop = $this->findNearestStop($request->latitude, $request->longitude, true);

            try {

                if ($nearestStop) {
                    foreach ($nearestStop as $stop) {
                        $stop = Stop::find($stop->id);
                        if ($stop) {
                            $users = $stop->users()
                                ->whereHas('bus', function ($query) use ($bus) {
                                    $query->where('id', $bus->id);
                                })
                                ->get();

                            if (!$users->isEmpty()) {


                                $busTmp = $bus->toArray();
                                foreach ($users as $user) {
                                    Mail::to($user->email)->send(new BusArrived([
                                        'student_name' => $user->name,
                                        'student_class' => $user->class,
                                        'student_roll' => $user->roll_no,
                                        'bus_number' => $busTmp['number'],
                                        'bus_driver' => $driver->name,
                                        'bus_driver_phone' => $driver->phone,
                                        'faculty_name' => $bus->facultyIncharge->faculty->name ?? null,
                                        'faculty_phone' => $bus->facultyIncharge->faculty->phone ?? null,
                                    ]));

                                    Log::info('Bus location update email sent', [
                                        'user_id' => $user->id,
                                        'bus_id' => $bus->id,
                                        'driver_id' => $driver->id,
                                        'stop_id' => $stop->id,
                                        'latitude' => $request->latitude,
                                        'longitude' => $request->longitude,
                                    ]);
                                }
                            }
                        }
                    }
                } else {
                    Log::info('No nearest stop found for bus location update.', [
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error sending email', [
                    'error' => $e->getMessage(),
                    'bus_id' => $bus->id,
                    'driver_id' => $driver->id,
                ]);
            }

            return response()->json(['message' => 'Location updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'An error occurred while updating location.',
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function locations(Request $request, $busId)
    {
        if (!$busId) {
            return response()->json(['error' => 'Bus ID is required.'], 400);
        }

        $bus = Bus::find($busId);
        if (!$bus) {
            return response()->json(['error' => 'Bus not found.'], 404);
        }

        $locations = BusLocation::with('bus')
            ->where('bus_id', $busId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Group locations by bus ID
        $locations = $locations->groupBy('bus_id');
        return response()->json($locations);
    }

    public function trackBuses()
    {
        $buses = Bus::with('locations')->paginate(10);
        return view('trackBus.index', compact('buses'));
    }

    public function track($busId)
    {
        $bus = Bus::with('locations')->find($busId);

        if (!$bus) {
            return abort(404, 'Bus not found');
        }

        return view('trackBus.show', compact('bus'));
    }

    public function attendance(Request $request)
    {

        try {
            $userId = Student::where('roll_no', $request->roll_no)->first();

            if (!$userId) {
                return response()->json(['error' => 'Student not found.'], 404);
            }

            $stop = $this->findNearestStop($request->latitude, $request->longitude);
            if (!$stop) {
                return response()->json(['error' => 'No stops found nearby.'], 404);
            }

            $stop = Stop::find($stop->id);
            $route = Route::whereIn('id', RouteStop::where('stop_id', $stop->id)->pluck('route_id'))->first();

            if (!$route) {
                return response()->json(['error' => 'No route found for the stop.'], 404);
            }

            // Morning time check
            $towardsCollege = now()->between(
                now()->setHour(6)->setMinute(0)->setSecond(0),
                now()->setHour(9)->setMinute(30)->setSecond(0)
            ) ? true : false;

            $attendance = Attendance::where('user_id', $userId->user_id)
                ->whereDate('check_in', now()->format('Y-m-d'))
                ->where('bus_id', $request->bus_id)
                ->where('route_id', $route->id)
                ->first();

            if ($attendance) {

                if ($attendance->check_out) {
                    return response()->json(['error' => 'Attendance already marked for today.'], 400);
                }

                $attendance->update([
                    'check_out' => now(),
                    'check_out_stop_id' => $stop->id,
                    'check_out_latitude' => (float) $request->latitude,
                    'check_out_longitude' => (float) $request->longitude,
                ]);

                Log::info('Attendance updated', [
                    'user_id' => $userId->user_id,
                    'check_out' => now(),
                    'check_out_stop_id' => $stop->id,
                    'check_out_latitude' => (float) $request->latitude,
                    'check_out_longitude' => (float) $request->longitude,
                ]);
            } else {
                $attendance = Attendance::create([
                    'user_id' => $userId->user_id,
                    'check_in' => now(),
                    'check_in_stop_id' => $stop->id,
                    'check_in_latitude' => (float) $request->latitude,
                    'check_in_longitude' => (float) $request->longitude,
                    'towards_college' => $towardsCollege,
                    'status' => 'Present',
                    'bus_id' => $request->bus_id,
                    'route_id' => $route->id,
                    'distance_traveled' => 0,
                ]);

                Log::info('Attendance created', [
                    'user_id' => $userId->user_id,
                    'check_in' => now(),
                    'check_in_stop_id' => $stop->id,
                    'check_in_latitude' => (float) $request->latitude,
                    'check_in_longitude' => (float) $request->longitude,
                ]);
            }

            return response()->json($attendance);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function findNearestStop($latitude, $longitude, $isArray = false)
    {
        $minDistance = 0;  // Minimum distance in meters
        $maxDistance = 1500; // Maximum distance in meters

        $nearestStop = DB::select("
            SELECT id, stop_name, latitude, longitude, 
            ( 6371000 * acos(
                cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(latitude))
            ) ) AS distance
            FROM stops
            HAVING distance BETWEEN ? AND ?
            ORDER BY distance ASC
            LIMIT 1
        ", [$latitude, $longitude, $latitude, $minDistance, $maxDistance]);

        if (!empty($nearestStop)) {
            if ($isArray) {
                return $nearestStop;
            }

            return $nearestStop[0];
        }

        return null;
    }

    /**
     * Show the form for assigning a route to a bus.
     */
    public function assignRouteForm(Bus $bus)
    {
        $routes = Route::all();
        return view('buses.assignroute', compact('bus', 'routes'));
    }

    /**
     * Assign a route to a bus.
     */
    public function assignRoute(Request $request, Bus $bus)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
        ]);

        $busRoute = BusRoute::updateOrCreate(
            ['bus_id' => $bus->id],
            ['route_id' => $request->route_id]
        );

        return redirect()->route('buses.show', $bus->id)->with('success', 'Route assigned successfully.');
    }
}
