<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Trails extends Model
{
    public static function saveTrails($trail)
    {
        $newTrail = new Trails();
        $newTrail->username = Auth::user()->username;
        $newTrail->trail = $trail;
        $newTrail->save();
    }
}
