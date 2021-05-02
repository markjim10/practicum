<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TempAnswer extends Model
{
    public $timestamps = false;

    public static function update_temp_answer($data)
    {
        $applicant = Applicant::where('user_id', Auth::user()->id)->first();
        $data = json_decode($data);
        $temp = TempAnswer::where('question_id', $data->qID)
            ->where('applicant_id', $applicant->id)->first();
        $temp->temp_answer = $data->temp;
        $temp->save();
    }
}
