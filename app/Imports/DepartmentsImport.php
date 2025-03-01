<?php

namespace App\Imports;

use App\Models\Department;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DepartmentsImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {
            $department = new Department();
            $department->dept_name = $row[0];
            $department->dept_code = $row[1];
            $department->degree = $row[2];
            $department->save();
        }
    }


    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
        ];
    }
}
