<?php

namespace App\Imports;

use App\Applicant;
use Maatwebsite\Excel\Concerns\ToModel;

class ApplicantsImport implements ToModel
{

    public function model(array $row)
    {
        return new Applicant([
            'id'     => $row[0],
            'user_id'    => $row[1],
            'first_name'    => $row[2],
            'middle_name'    => $row[3],
            'last_name'    => $row[4],
            'province'    => $row[5],
            'city'    => $row[6],
            'brgy'    => $row[7],
            'phone'    => $row[8],
            'date_of_birth'    => $row[9],
            'application'    => $row[10],
            'preferred_program'    => $row[11],
            'school_last_attended'    => $row[12],
            'applicant_photo'    => $row[13],
            'card_photo'    => $row[14],
        ]);
    }
}
