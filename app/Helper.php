<?php

namespace App;

use App\Trails;
use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    public static function validateEmail($email)
    {
        if (User::where('email', $email)->first() == null) {
            return "not taken";
        } else {
            return "taken";
        }
    }

    public static function validatePhone($phone)
    {
        if (Msisdn::validate($phone)) {
            return "valid";
        } else {
            return "invalid";
        }
    }

    public static function getMonths()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }

    public static function saveTrails($trail)
    {
        $newTrail = new Trails();
        $newTrail->username = Auth::user()->username;
        $newTrail->trail = $trail;
        $newTrail->save();
    }

    public static function generate($generate)
    {
    }
}
