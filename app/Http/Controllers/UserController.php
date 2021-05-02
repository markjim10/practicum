<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('users/editProfile', compact(
            'user'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($request->hasFile('photo')) {
            $user->photo = addslashes($_FILES['photo']['tmp_name']);
            $user->photo = file_get_contents($user->photo);
            $user->photo = base64_encode($user->photo);
        }
        $user->save();
        return redirect()->back()->with('message', 'Updated Photo');
    }

    public function changePassword(Request $request)
    {
        $old = $request->old_pass;
        $pass = $request->password;
        $confirm = $request->confirm_password;

        $user = User::where('id', $request->id)->first();
        if (!Hash::check($old, $user->password)) {
            return redirect()->back()->with('error', 'Wrong password');
        }

        if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $pass)) {
            return redirect()->back()->with('error', 'Password must contain letters and numbers');
        }

        if ($pass != $confirm) {
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        $user->password = Hash::make($pass);
        $user->save();
        return redirect()->back()->with('message', 'Password changed');
    }
}
