<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Bus;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'studentCount' => Student::count(),
            'facultyCount' => Faculty::count(),
            'busCount' => Bus::count(),
            'driverCount' => Driver::where('status', 'active')->count(),
            'chartData' => json_encode([
                'students' => Student::count(),
                'faculty' => Faculty::count(),
                'buses' => Bus::count(),
                'drivers' => Driver::count(),
            ]),
        ]);
    }
}


