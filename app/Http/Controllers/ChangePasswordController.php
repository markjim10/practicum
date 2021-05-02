<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePass($id)
    {
    }
}
