<?php

namespace App\Imports;

use App\AppResult;
use Maatwebsite\Excel\Concerns\ToModel;

class AppResultsImport implements ToModel
{
    public function model(array $row)
    {
        return new AppResult([
            'id'     => $row[0],
            'user_id'    => $row[1],
            'status'    => $row[2],
            'exam_date'    => $row[3],
            'exam_result'    => $row[4],
            'exam_score'    => $row[5],
            'time_start'    => $row[6],
            'time_end'    => $row[7],
        ]);
    }
}
