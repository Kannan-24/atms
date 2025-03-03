<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Show all buses for report selection
    public function index()
    {
        $buses = Bus::paginate(10); // Adjust the number 10 to the desired number of items per page
        return view('reports.index', compact('buses'));
    }

    // Generate PDF report for a specific bus
    public function generateBusReport($busId)
    {
        $bus = Bus::findOrFail($busId);
        $attendances = Attendance::with('student.user')->where('bus_id', $busId)->get();

        if ($attendances->isEmpty()) {
            return redirect()->route('reports.index')->with('error', 'No attendance records found for this bus.');
        }

        $pdf = Pdf::loadView('reports.bus_pdf', compact('bus', 'attendances'));

        return $pdf->download('attendance_report_bus_' . $bus->bus_number . '.pdf');
    }
}
