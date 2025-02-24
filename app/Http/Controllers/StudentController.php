<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Batches;
use App\Models\Department;
use App\Models\Classes;
use Illuminate\Http\Request;
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
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
