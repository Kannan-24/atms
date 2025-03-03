<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $attendances = Attendance::get();
        $students = Student::get();
        return view('reports.index', compact('attendances', 'students'));
    }

    public function generatePDF()
    {
        // Fetch attendance records
        $attendances = Attendance::get();
        $students = Student::get();

        // Load view and pass data
        $pdf = Pdf::loadView('reports.pdf', compact('attendances', 'students'));

        // Download the generated PDF
        return $pdf->download('attendance_report.pdf');
    }
}
