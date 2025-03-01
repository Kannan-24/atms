<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepartmentsImport;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate(9);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dept_name' => 'required|string|max:255',
            'dept_code' => 'required|string|max:20',
            'degree' => 'required|string|max:255',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'dept_name' => 'required|string|max:255',
            'dept_code' => 'required|string|max:20',
            'degree' => 'required|string|max:255',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }

    
    /**
     * Show the import form.
     */
    public function import()
    {
        return view('departments.import');
    }
    
    public function importdepartments(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv'
        ]);
    
        Excel::import(new DepartmentsImport, $request->file('file'));
    
        return redirect()->route('departments.index')
            ->with('success', 'Departments imported successfully.');
    }
}
