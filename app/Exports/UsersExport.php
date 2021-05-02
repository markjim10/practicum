<?php

namespace App\Exports;

use App\Trails;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        Trails::saveTrails("Downloaded Users Table");

        $users = User::all();
        $encryptedUsers = [];
        foreach ($users as $user) {
            array_push($encryptedUsers, (object)[
                'id' => openssl_encrypt($user->id, "AES-128-ECB", ''),
                'username' => openssl_encrypt($user->username, "AES-128-ECB", ''),
                'email' => openssl_encrypt($user->email, "AES-128-ECB", ''),
                'password' => openssl_encrypt($user->password, "AES-128-ECB", ''),
                'role' => openssl_encrypt($user->role, "AES-128-ECB", ''),
            ]);
        }
        $c = collect($encryptedUsers);
        return $c;
    }
}
