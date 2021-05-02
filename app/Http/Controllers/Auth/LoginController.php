<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string', 'password' => 'required|string',
        ]);
    }

    public function redirectTo()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return '/admins';
        } elseif ($role == 'applicant') {
            return '/applicants';
        } elseif ($role == 'sysadmin') {
            return '/sysadmins';
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
