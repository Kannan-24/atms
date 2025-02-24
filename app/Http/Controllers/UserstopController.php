<?php

namespace App\Http\Controllers;

use App\Models\Userstop;
use App\Models\User;
use App\Models\Stop;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;

class UserstopController extends Controller
{
    /**
     * Display a listing of user stops.
     */
    public function index()
    {
        $userstops = Userstop::with('user')->paginate(10);
        return view('userstops.index', compact('userstops'));
    }

    /**
     * Show the form for creating a new user stop.
     */
    public function create()
    {
        $users = User::all();
        $stops = Stop::all();
        $students = Student::all();
        $faculties = Faculty::all();
        return view('userstops.create', compact('users', 'stops', 'students', 'faculties'));
    }

    /**
     * Store a newly created user stop in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stop_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        Userstop::create([
            'stop_id' => $request->stop_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('userstops.index')->with('success', 'User stop added successfully.');
    }

    /**
     * Show the details of a specific user stop.
     */
    public function show(Userstop $userstop)
    {
        return view('userstops.show', compact('userstop'));
    }

    /**
     * Show the form for editing a user stop.
     */
    public function edit(Userstop $userstop)
    {
        $users = User::all();
        return view('userstops.edit', compact('userstop', 'users'));
    }

    /**
     * Update a user stop's details.
     */
    public function update(Request $request, Userstop $userstop)
    {
        $request->validate([
            'stop_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $userstop->update([
            'stop_id' => $request->stop_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('userstops.index')->with('success', 'User stop updated successfully.');
    }

    /**
     * Remove a user stop from the system.
     */
    public function destroy(Userstop $userstop)
    {
        $userstop->delete();
        return redirect()->route('userstops.index')->with('success', 'User stop deleted successfully.');
    }
}
