<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Attendance;
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
        $bus = Bus::with('students.user')->findOrFail($busId);
        return view('reports.show', compact('bus'));
    }

    /**
     * Generate PDF report for a specific bus.
     */
    public function generateBusPDF($busId)
    {
        $bus = Bus::with('students.user')->findOrFail($busId);

        $pdf = Pdf::loadView('reports.bus_pdf', compact('bus'));

        return $pdf->download('attendance_report_bus_' . $bus->number . '.pdf');
    }
}
