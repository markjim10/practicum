<?php

namespace App\Exports;

use App\Trails;
use App\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicantsExport implements FromCollection
{
    // public function collection()
    // {
    //     return Applicant::all();
    // }

    public function collection()
    {
        Trails::saveTrails("Downloaded Applicants Table");

        $applicants = Applicant::all();
        $encryptedUsers = [];
        foreach ($applicants as $app) {
            array_push($encryptedUsers, (object)[
                'id' => openssl_encrypt($app->id, "AES-128-ECB", ''),
                'user_id' => openssl_encrypt($app->user_id, "AES-128-ECB", ''),
                'program_id' => openssl_encrypt($app->program_id, "AES-128-ECB", ''),
                'status' => openssl_encrypt($app->status, "AES-128-ECB", ''),
                'first_name' => openssl_encrypt($app->first_name, "AES-128-ECB", ''),
                'middle_name' => openssl_encrypt($app->middle_name, "AES-128-ECB", ''),
                'last_name' => openssl_encrypt($app->last_name, "AES-128-ECB", ''),
                'province' => openssl_encrypt($app->province, "AES-128-ECB", ''),
                'city' => openssl_encrypt($app->city, "AES-128-ECB", ''),
                'phone' => openssl_encrypt($app->phone, "AES-128-ECB", ''),
                'date_of_birth' => openssl_encrypt($app->date_of_birth, "AES-128-ECB", ''),
                'application' => openssl_encrypt($app->application, "AES-128-ECB", ''),
                'school_last_attended' => openssl_encrypt($app->school_last_attended, "AES-128-ECB", ''),
                'card_photo' => openssl_encrypt($app->card_photo, "AES-128-ECB", ''),
            ]);
        }
        return collect($encryptedUsers);
    }
}
