<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public static function store_feedback($request)
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();

        $feedback = new Feedback();
        $feedback->applicant_id = $app->id;
        $feedback->message = $request->message;
        $feedback->save();

        Trails::saveTrails("Feedback has been sent by " . $app->first_name . " " . $app->last_name);
    }
}
