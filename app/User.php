<?php

namespace App;

use App\Applicant;
use App\UserAdmin;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function userAdmin()
    {
        return $this->hasOne(UserAdmin::class);
    }

    protected $fillable = [
        'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerAdmin(Request $request)
    {
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $confirm = $request->confirm_password;
        $role = $request->role;

        $user = User::where('email', $email)->orWhere('username', $username)->first();
        if ($user) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'Email/Username is not available'
                ]);
        } else if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'Password must contain letters and numbers'
                ]);
        } else if ($password != $confirm) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'Passwords do not match'
                ]);
        } else {

            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->save();

            $admin = new UserAdmin();
            $admin->user_id = $user->id;
            $admin->name = $name;
            $admin->save();

            Trails::saveTrails("Created new user " . $username . " as " . $role);
            return response()
                ->json([
                    'result' => 'success',
                    'message' => 'Successfully created a new user'
                ]);
        }
    }
}
