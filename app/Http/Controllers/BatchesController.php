<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BatchesImport;

class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batches::paginate(9);
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_year' => 'required|date_format:Y',
            'end_year' => 'required|date_format:Y',
        ]);

        Batches::create($request->all());

        return redirect()->route('batches.index')
            ->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $batch = Batches::with('classes.department')->findOrFail($id);

        foreach ($batch->classes as $class) {
            $class->academicYearRoman = $this->getAcademicYearRoman($class->batch->start_year);
        }

        return view('batches.show', compact('batch'));
    }

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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batches $batch)
    {
        return view('batches.edit', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batches $batch)
    {
        $request->validate([
            'start_year' => 'required|date_format:Y',
            'end_year' => 'required|date_format:Y',
        ]);

        $batch->update($request->all());

        return redirect()->route('batches.index')
            ->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batches $batches)
    {
        $batches->delete();

        return redirect()->route('batches.index')
            ->with('success', 'Batch deleted successfully.');
    }
    public function importForm()
    {
        return view('batches.import');
    }

    // Handle File Import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);


        // Process CSV Import
        Excel::import(new BatchesImport, $request->file('file'));

        return redirect()->route('batches.index')->with('success', 'Batches imported successfully!');
    }
}
