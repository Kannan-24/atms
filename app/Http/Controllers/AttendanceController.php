<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Bus;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a list of all buses with attendance records.
     */
    public function index()
    {
        $buses = Bus::paginate(10); // Adjust the number 10 to the desired number of items per page
        return view('attendance.index', compact('buses'));
    }

    /**
     * Special create form for attendance records for a specific bus.
     */
    public function create(Bus $bus)
    {
        return view('attendance.create', compact('bus'));
    }

    /**
     * Show attendance records for a specific bus.
     */
    public function show(Request $request, $bus_id)
    {
        $date = $request->input('date') ?? date('Y-m-d');
        $towards_college = $request->input('towards_college') ?? 1;

        $bus = Bus::findOrFail($bus_id);
        $buses = Bus::all();

        $attendance = Attendance::where('bus_id', $bus_id)
            ->whereDate('check_in', $date)
            ->orderBy('check_in', 'asc')
            ->where('towards_college', $towards_college)
            ->get();

        return view('attendance.show', compact('bus'))
            ->with('buses', $buses)
            ->with('date', $date)
            ->with('attendance', $attendance)
            ->with('towards_college', $towards_college);
    }
}
