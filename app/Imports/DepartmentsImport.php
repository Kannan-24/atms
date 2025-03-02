<?php

namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartmentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Normalize headers (handle variations in capitalization or extra spaces)
        return new Department([
            'dept_name' => trim($row['dept_name'] ?? ''), // Prevent undefined key errors
            'dept_code' => trim($row['dept_code'] ?? ''),
            'degree' => trim($row['degree'] ?? ''),
        ]);
    }
}
