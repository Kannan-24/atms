<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Create user record
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make('defaultpassword'), // Set default password
        ]);

        // Create student record
        return new Student([
            'user_id'     => $user->id,
            'roll_no'     => $row['roll_no'],
            'dob'         => $row['dob'],
            'blood_group' => $row['blood_group'],
            'address'     => $row['address'],
            'batch_id'    => $row['batch_id'],
            'class_id'    => $row['class_id'],
            'dept_id'     => $row['dept_id'],
        ]);
    }
}
