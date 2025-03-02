<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Batches;
use App\Models\Department;
use App\Models\Classes;
use App\Models\Stop;
use App\Models\UserStop;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::with(['user', 'class.department'])->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $batches = Batches::all();
        $departments = Department::all();
        $classes = Classes::all();
        return view('students.create', compact('batches', 'departments', 'classes'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'roll_no' => 'required|string|max:50|unique:students,roll_no',
            'dob' => 'required|date',
            'blood_group' => 'required|string',
            'address' => 'required|string',
            'batch_id' => 'required|integer|exists:batches,id',
            'class_id' => 'required|integer|exists:classes,id',
            'dept_id' => 'required|integer|exists:departments,id',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('defaultpassword'), // Set a default password or generate one
        ]);

        // Create student record
        Student::create([
            'user_id' => $user->id,
            'roll_no' => $request->roll_no,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'batch_id' => $request->batch_id,
            'class_id' => $request->class_id,
            'dept_id' => $request->dept_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    /**
     * Show the details of a specific student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(Student $student)
    {
        $batches = Batches::all();
        $departments = Department::all();
        $classes = Classes::all();
        return view('students.edit', compact('student', 'batches', 'departments', 'classes'));
    }

    /**
     * Update a student's details.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'phone' => 'required|string|max:15',
            'roll_no' => 'required|string|max:50|unique:students,roll_no,' . $student->id,
            'dob' => 'required|date',
            'blood_group' => 'required|string',
            'address' => 'required|string',
            'batch_id' => 'required|integer|exists:batches,id',
            'class_id' => 'required|integer|exists:classes,id',
            'dept_id' => 'required|integer|exists:departments,id',
        ]);

        // Update user account
        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update student record
        $student->update([
            'roll_no' => $request->roll_no,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'batch_id' => $request->batch_id,
            'class_id' => $request->class_id,
            'dept_id' => $request->dept_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove a student from the system.
     */
    public function destroy(Student $student)
    {
        // Delete the user associated with the student
        $student->user->delete();

        // Delete the student record
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student and associated user deleted successfully.');
    }

    /**
     * Show the form for assigning a stop to a student.
     */

    public function assignStops(Student $student)
    {
        $stops = Stop::all();
        return view('students.assign_stops', compact('student', 'stops'));
    }

    /**
     * Update the assigned stop for a student.
     */
    public function updateAssignedStop(Request $request, Student $student)
    {
        $request->validate([
            'stop_id' => 'required|integer|exists:stops,id',
        ]);

        // Find existing stop assignment
        $userStop = UserStop::where('user_id', $student->user_id)->first();

        if ($userStop) {
            // Update existing assignment
            $userStop->update([
                'stop_id' => $request->stop_id,
            ]);
        } else {
            // Create a new assignment if it doesn't exist
            UserStop::create([
                'user_id' => $student->user_id,
                'stop_id' => $request->stop_id,
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Stop updated successfully.');
    }


    public function editStop(Student $student)
    {
        $stops = Stop::all(); // Fetch all available stops
        $assignedStop = UserStop::where('user_id', $student->user_id)->first();

        return view('students.edit_stop', compact('student', 'stops', 'assignedStop'));
    }

    
    public function showImportForm()
    {
        $batches = Batches::all();
        $departments = Department::all();
        $classes = Classes::all();

        if ($batches->isEmpty() || $departments->isEmpty() || $classes->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'Please add Batches, Departments, and Classes first!');
        }

        return view('students.import', compact('batches', 'departments', 'classes'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx',
            'batch_id' => 'required|exists:batches,id',
            'dept_id' => 'required|exists:departments,id',
            'class_id' => 'required|exists:classes,id',
        ]);

        try {
            Excel::import(new StudentsImport($request->batch_id, $request->dept_id, $request->class_id), $request->file('file'));

            return redirect()->route('students.index')
                ->with('success', 'Students imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing students: ' . $e->getMessage());
        }
    }

}

