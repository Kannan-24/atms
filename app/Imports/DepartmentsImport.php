<?php

namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;

class DepartmentsImport implements ToModel
{
    public function model(array $row)
    {
        return new Department([
            'dept_name' => $row[0], // Adjust according to your Excel columns
            'dept_code' => $row[1],
            'degree' => $row[2],
        ]);
    }
}
