<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch all attendance records
        $attendances = Attendance::with('student.user', 'bus')->get();

        return view('reports.index', compact('attendances'));
    }

    public function generatePDF()
    {
        // Fetch attendance records
        $attendances = Attendance::with('student.user', 'bus')->get();

        // Load view and pass data
        $pdf = Pdf::loadView('reports.pdf', compact('attendances'));

        // Download the generated PDF
        return $pdf->download('attendance_report.pdf');
    }
}
