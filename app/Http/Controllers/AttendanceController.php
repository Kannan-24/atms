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
        $buses = Bus::all();
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
    public function show($bus_id)
    {
        $bus = Bus::findOrFail($bus_id);
        return view('attendance.show', compact('bus'));
    }
}
