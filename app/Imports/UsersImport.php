<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'id'     => openssl_decrypt($row[0], "AES-128-ECB", ''),
            'username'    => openssl_decrypt($row[1], "AES-128-ECB", ''),
            'email'    => openssl_decrypt($row[2], "AES-128-ECB", ''),
            'password'    => openssl_decrypt($row[3], "AES-128-ECB", ''),
            'role'    => openssl_decrypt($row[4], "AES-128-ECB", ''),
        ]);
    }
}

// $password = openssl_decrypt($student->password, "AES-128-ECB", '');
