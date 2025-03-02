<?php

namespace App\Imports;

use App\Models\Faculty;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacultyImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Create a user record
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make('Atms@2025'), // Default password
        ]);

        // Create faculty record
        return new Faculty([
            'user_id' => $user->id,
            'ts_id' => $row['ts_id'],
            'dob' => $row['dob'],
            'blood_group' => $row['blood_group'],
            'address' => $row['address'],
            'dept_id' => Department::where('id', $row['dept_id'])->value('id'), // Ensure department exists
        ]);
    }
}
