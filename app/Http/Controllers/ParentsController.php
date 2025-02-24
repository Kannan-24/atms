<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\User;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Batches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentsController extends Controller
{
    /**
     * Display a listing of parents.
     */
    public function index()
    {
        $parents = Parents::with(['user', 'student'])->paginate(10);
        return view('parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new parent.
     */
    public function create()
    {
        $students = Student::all();
        return view('parents.create', compact('students'));
    }

    /**
     * Store a newly created parent in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'relation' => 'required|string|max:50',
            'student_id' => 'required|integer|exists:students,id',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('defaultpassword'), // Set a default password or generate one
        ]);

        // Create parent record
        Parents::create([
            'user_id' => $user->id,
            'student_id' => $request->student_id,
            'relation' => $request->relation,
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent added successfully.');
    }

    /**
     * Show the details of a specific parent.
     */
    public function show(Parents $parent)
    {
        $students = Student::all();
        $classes = Classes::all();
        $batches = Batches::all();
        return view('parents.show', compact('parent', 'students', 'classes', 'batches'));
    }

    /**
     * Show the form for editing a parent.
     */
    public function edit(Parents $parent)
    {
        $students = Student::all();
        return view('parents.edit', compact('parent', 'students'));
    }

    /**
     * Update a parent's details.
     */
    public function update(Request $request, Parents $parent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $parent->user_id,
            'phone' => 'required|string|max:15',
            'relation' => 'required|string|max:50',
            'student_id' => 'required|integer|exists:students,id',
        ]);

        // Update user account
        $parent->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update parent record
        $parent->update([
            'student_id' => $request->student_id,
            'relation' => $request->relation,
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');
    }

    /**
     * Remove a parent from the system.
     */
    public function destroy(Parents $parent)
    {
        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }
}
