<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Driver;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'state' => 'nullable|string',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'dob' => 'nullable|date',
        ]);

        // Update user table fields
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'state' => $request->state,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);

        // Update role-specific details based on user_type
        if ($user->user_type == 'student') {
            $request->validate([
                'department' => 'required|string|max:255',
                'batch' => 'nullable|string|max:255',
            ]);

            Student::updateOrCreate(
                ['user_id' => $user->id],
                ['department' => $request->department, 'batch' => $request->batch]
            );
        } elseif ($user->user_type == 'faculty') {
            $request->validate([
                'subject' => 'required|string|max:255',
                'experience' => 'nullable|integer|min:0',
            ]);

            Faculty::updateOrCreate(
                ['user_id' => $user->id],
                ['subject' => $request->subject, 'experience' => $request->experience]
            );
        } elseif ($user->user_type == 'driver') {
            $request->validate([
                'license_number' => 'required|string|max:255',
                'experience' => 'nullable|integer|min:0',
            ]);

            Driver::updateOrCreate(
                ['user_id' => $user->id],
                ['license_number' => $request->license_number, 'experience' => $request->experience]
            );
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
