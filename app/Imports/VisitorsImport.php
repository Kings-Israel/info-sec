<?php

namespace App\Imports;

use App\Models\Visitor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VisitorsImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    /**
    * @param Visitor
    */
    public function model(array $row)
    {
        if ($row[1] != '') {
            $visitors = Visitor::all()->pluck('name');

            $is_uploaded = $visitors->contains(function ($visitor) use ($row) {
                return strtolower($visitor) == strtolower($row[1]);
            });

            if (!$is_uploaded) {
                return new Visitor([
                    // 'category' => $row[0],
                    'name' => $row[1],
                    'Company' => $row[2] != '' ? $row[2] : NULL,
                    // 'Role' => $row[3] && $row[3] != '' ? $row[3] : NULL,
                    // 'Country' => $row[3],
                ]);
            }
        }
    }
}
