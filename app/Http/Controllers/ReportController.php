<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the list of buses for report generation.
     */
    public function index()
    {
        $buses = Bus::with('route')->paginate(10);
        return view('reports.index', compact('buses'));
    }

    /**
     * Show form to select date & time before generating the report.
     */
    public function showBusReportForm($busId)
    {
        $bus = Bus::findOrFail($busId);
        return view('reports.select_date_time', compact('bus'));
    }

    /**
     * Generate the bus attendance report based on the selected date and time.
     */
    public function generateBusReport(Request $request, $busId)
    {
        $bus = Bus::findOrFail($busId);
        $date = $request->input('date');
        $timeSlot = $request->input('time_slot'); // 1 = Morning, 0 = Evening, 2 = Both

        // Query attendance based on selected time slot
        $attendanceQuery = Attendance::where('bus_id', $busId)->whereDate('check_in', $date);

        if ($timeSlot != 2) {
            $attendanceQuery->where('towards_college', $timeSlot);
        }

        $attendanceRecords = $attendanceQuery->get();

        return view('reports.show', compact('bus', 'date', 'timeSlot', 'attendanceRecords'));
    }

    /**
     * Generate and Download PDF Report.
     */
    public function generateBusPDF(Request $request, $busId)
    {
        $bus = Bus::findOrFail($busId);
        $date = $request->input('date');
        $timeSlot = $request->input('time_slot');

        $attendanceQuery = Attendance::where('bus_id', $busId)->whereDate('check_in', $date);

        if ($timeSlot != 2) {
            $attendanceQuery->where('towards_college', $timeSlot);
        }

        $attendanceRecords = $attendanceQuery->get();

        $pdf = Pdf::loadView('reports.bus_pdf', compact('bus', 'date', 'timeSlot', 'attendanceRecords'));
        return $pdf->download("attendance_report_bus_{$bus->number}_{$date}.pdf");
    }
}
