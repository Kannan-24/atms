<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Department;
use App\Models\Batches;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $batches = Batches::all();
        $classes = Classes::with('department', 'batch')->paginate(9);

        foreach ($classes as $class) {
            $class->academicYearRoman = $this->getAcademicYearRoman($class->batch->start_year);
        }

        return view('classes.index', compact('classes', 'departments', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $batches = Batches::all();

        return view('classes.create', compact('departments', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dept_id' => 'required|exists:departments,id',
            'batch_id' => 'required|exists:batches,id',
            'section' => 'required|string|max:255',
        ]);

        Classes::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $class)
    {
        $class->load('batch', 'department');

        // Assign academic year in Roman numerals
        $class->academicYearRoman = $this->getAcademicYearRoman($class->batch->start_year);

        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $class)
    {
        $departments = Department::all();
        $batches = Batches::all();

        return view('classes.edit', compact('class', 'departments', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'dept_id' => 'required|exists:departments,id',
            'batch_id' => 'required|exists:batches,id',
            'section' => 'required|string|max:255',
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    /**
     * Get the academic year in Roman numerals.
     */

    private function getAcademicYearRoman($startYear)
    {
        $currentYear = date('Y');
        $academicYear = $currentYear - $startYear;

        if ($academicYear < 1) {
            $academicYear = 1;
        } elseif ($academicYear > 5) { // Adjust this based on course duration
            $academicYear = 5;
        }

        $yearMap = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V'];

        return $yearMap[$academicYear] ?? 'NA';
    }
}
