<?php

namespace App\Exports;

use App\Trails;
use App\AppResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class AppResultsExport implements FromCollection, WithStrictNullComparison
{
    // public function collection()
    // {
    //     return AppResult::all();
    // }

    public function collection()
    {
        Trails::saveTrails("Downloaded AppResult Table");

        $appResults = AppResult::all();
        $encryptedUsers = [];
        foreach ($appResults as $result) {
            array_push($encryptedUsers, (object)[
                'id' => openssl_encrypt($result->id, "AES-128-ECB", ''),
                'applicant_id' => openssl_encrypt($result->applicant_id, "AES-128-ECB", ''),
                'status' => openssl_encrypt($result->status, "AES-128-ECB", ''),
                'exam_date' => openssl_encrypt($result->exam_date, "AES-128-ECB", ''),
                'exam_result' => openssl_encrypt($result->exam_result, "AES-128-ECB", ''),
                'exam_score' => openssl_encrypt($result->exam_score, "AES-128-ECB", ''),
                'time_start' => openssl_encrypt($result->time_start, "AES-128-ECB", ''),
                'time_end' => openssl_encrypt($result->time_end, "AES-128-ECB", ''),
            ]);
        }
        $c = collect($encryptedUsers);
        return $c;
    }

    public function startCell(): string
    {
        return '0';
    }
}
