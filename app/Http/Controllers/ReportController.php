<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Step 1: Show the list of buses to generate reports
    public function index()
    {
        $buses = Bus::paginate(10); // Adjust the number 10 to the desired number of items per page
        return view('reports.index', compact('buses'));
    }

    // Step 2: Show report details after clicking a bus
    public function showBusReport($busId)
    {
        $bus = Bus::with('students.user', 'students.busAttendance')->findOrFail($busId);
        $attendances = Attendance::with('student.user')->where('bus_id', $busId)->get();

        return view('reports.show', compact('bus', 'attendances'));
    }

    // Step 3: Generate PDF for the selected bus
    public function generateBusPDF($busId)
    {
        $bus = Bus::with('students.user', 'students.busAttendance')->findOrFail($busId);
        $attendances = Attendance::with('student.user')->where('bus_id', $busId)->get();

        $pdf = Pdf::loadView('reports.bus_pdf', compact('bus', 'attendances'));
        return $pdf->download('attendance_report_bus_' . $bus->bus_number . '.pdf');
    }
}
