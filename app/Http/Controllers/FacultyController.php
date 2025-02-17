<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculty = Faculty::all();
        return view('faculty.index', compact('faculty'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employee_id' => 'required',
            'email' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        Faculty::create([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('faculty.index')
            ->with('success', 'Faculty created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required',
            'employee_id' => 'required',
            'email' => 'required',
        ]);

        $faculty->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $faculty->update([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
        ]);

        return redirect()->route('faculty.index')
            ->with('success', 'Faculty updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->user->delete();
        $faculty->delete();
        return redirect()->route('faculty.index')
            ->with('success', 'Faculty deleted successfully');
    }
}
