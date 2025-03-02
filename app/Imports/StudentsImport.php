<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    protected $batch_id, $dept_id, $class_id;

    public function __construct($batch_id, $dept_id, $class_id)
    {
        $this->batch_id = $batch_id;
        $this->dept_id = $dept_id;
        $this->class_id = $class_id;
    }

    public function model(array $row)
    {
        Log::info('Importing row: ', $row);

        // Create User
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make('Atms@123'),
        ]);

        return new Student([
            'user_id' => $user->id,
            'roll_no' => $row['roll_no'],
            'dob' => $row['dob'],
            'blood_group' => $row['blood_group'],
            'address' => $row['address'],
            'batch_id' => $this->batch_id,
            'class_id' => $this->class_id,
            'dept_id' => $this->dept_id,
        ]);
    }
}
