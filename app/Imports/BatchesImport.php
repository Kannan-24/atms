<?php

namespace App\Imports;

use App\Models\Batches;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BatchesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Batches([
            'start_year' => $row['start_year'],
            'end_year' => $row['end_year'],
        ]);
    }
}
