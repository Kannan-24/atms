<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Attendance;
use App\Models\Route;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the list of buses to generate reports.
     */
    public function index()
    {
        $buses = Bus::with('route')->paginate(10);
        return view('reports.index', compact('buses'));
    }

    /**
     * Show attendance details for a selected bus.
     */
    public function showBusReport($busId)
    {

        $bus = Bus::findOrFail($busId);
        return view('reports.show', compact('bus'));
    }

    /**
     * Generate a PDF report for a selected bus.
     */
    public function generateBusPDF($busId)
    {
        $bus = Bus::with(['route', 'facultyIncharge.faculty'])->findOrFail($busId);
        $attendances = Attendance::with('student.user')->where('bus_id', $busId)->get();

        if ($attendances->isEmpty()) {
            return redirect()->route('reports.index')->with('error', 'No attendance records found for this bus.');
        }

        $pdf = Pdf::loadView('reports.bus_pdf', compact('bus', 'attendances'));
        return $pdf->download('attendance_report_bus_' . $bus->bus_number . '.pdf');
    }
}
