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
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('sysadmin');
    }

    public function index()
    {
        $admin = UserAdmin::where('id', Auth::user()->id)->first();
        $users = User::where('role', '!=', 'applicant')->get();
        return view('sysadmins.index', compact('users', 'admin'));
    }

    public function register_user(Request $request)
    {
        $response = $this->user->registerAdmin($request);
        $response = json_decode($response->getContent());
        return redirect()->back()->with($response->result, $response->message);
    }

    public function edit($id)
    {
        return User::where('id', $id)->first();
    }

    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->role = $request->role;
        $user->save();

        Trails::saveTrails("Updated user " . $user->username . " as " . $user->role);
        return redirect()->back()->with('message', 'User updated');
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        Trails::saveTrails("Removed user " . $user->username);
        return redirect()->back()->with('message', 'User deleted');
    }

    public function database()
    {
        return view('sysadmins.database');
    }

    public function trails()
    {
        $trails = Trails::orderBy('id', 'DESC')->get();
        return view('sysadmins.trails', compact('trails'));
    }
}
