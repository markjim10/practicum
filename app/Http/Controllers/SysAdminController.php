<?php

namespace App\Http\Controllers;

use App\User;
use App\Helper;
use App\Trails;
use App\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SysAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('sysadmin');
    }

    public function index()
    {
        $admin = UserAdmin::where('id', Auth::user()->id)->first();
        $users = User::where('role', '!=', 'applicant')->get();
        return view('sysadmins.index', compact('users', 'admin'));
    }

    public function view_users()
    {
        return view('sysadmins.registerUser');
    }

    public function registerUser(Request $request)
    {
        $message = User::createNewUser($request);

        if ($message == "Email/Username is not available") {
            return redirect()->back()->with('error', $message);
        } else if ($message == "Passwords do not match") {
            return redirect()->back()->with('error', $message);
        } else if ($message == "Password must contain letters and numbers") {
            return redirect()->back()->with('error', $message);
        } else {
            return redirect()->back()->with('message', $message);
        }
    }

    public function view_database()
    {
        return view('sysadmins.view_database');
    }

    public function view_trails()
    {
        $trails = Trails::orderBy('id', 'DESC')->get();
        return view('sysadmins.view_trails', compact('trails'));
    }

    public function remove_user($id)
    {
        $user = User::where('id', $id)->first();
        $trail = "Removed user " . $user->username;

        Helper::saveTrails($trail);
        $user->delete();

        $users = User::where('role', '!=', 'applicant')->get();
        return view('sysadmins.index', compact('users'));
    }

    public function edit_user($id)
    {
        $user = User::where('id', $id)->first();
        return view('sysadmins.edit', compact('user'));
    }

    public function update_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->role = $request->role;
        $user->save();

        $trail = "Updated user " . $user->username . " as " . $user->role;
        Helper::saveTrails($trail);

        return redirect()->back()->with('message', 'User updated.');
    }
}
