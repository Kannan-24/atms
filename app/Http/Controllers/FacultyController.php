<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the faculty.
     */
    public function index()
    {
        $faculty = Faculty::with('user', 'department')->paginate(10); 
        return view('faculty.index', compact('faculty'));

    }

    /**
     * Show the form for creating a new faculty.
     */
    public function create()
    {
        $departments = Department::all();
        return view('faculty.create', compact('departments'));
    }

    /**
     * Store a newly created faculty in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'ts_id' => 'required|string|max:50|unique:faculty,ts_id',
            'dob' => 'required|date',
            'blood_group' => 'required|string',
            'address' => 'required|string',
            'dept_id' => 'required|integer|exists:departments,id',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('defaultpassword'), // Set a default password or generate one
        ]);

        // Create faculty record
        Faculty::create([
            'user_id' => $user->id,
            'ts_id' => $request->ts_id,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'dept_id' => $request->dept_id,
        ]);

        return redirect()->route('faculty.index')->with('success', 'Faculty added successfully.');
    }

    /**
     * Show the details of a specific faculty.
     */
    public function show(Faculty $faculty)
    {
        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing a faculty.
     */
    public function edit(Faculty $faculty)
    {
        $departments = Department::all();
        return view('faculty.edit', compact('faculty', 'departments'));
    }

    /**
     * Update a faculty's details.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $faculty->user_id,
            'phone' => 'required|string',
            'ts_id' => 'required|string|max:50|unique:faculty,ts_id,' . $faculty->id,
            'dob' => 'required|date',
            'blood_group' => 'required|string',
            'address' => 'required|string',
            'dept_id' => 'required|integer|exists:departments,id',
        ]);

        // Update user account
        $faculty->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update faculty record
        $faculty->update([
            'ts_id' => $request->ts_id,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'dept_id' => $request->dept_id,
        ]);

        return redirect()->route('faculty.index')->with('success', 'Faculty updated successfully.');
    }

    /**
     * Remove a faculty from the system.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->user->delete();
        $faculty->delete();
        return redirect()->route('faculty.index')->with('success', 'Faculty deleted successfully.');
    }
}
