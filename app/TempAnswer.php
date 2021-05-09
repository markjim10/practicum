<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TempAnswer extends Model
{
    public $timestamps = false;

    public static function update_temp_answer($request)
    {
        $applicant = Applicant::where('user_id', Auth::user()->id)->first();
        $temp = TempAnswer::where('question_id', $request->qID)
            ->where('applicant_id', $applicant->id)->first();
        $temp->temp_answer = $request->temp;
        $temp->save();
    }
}
