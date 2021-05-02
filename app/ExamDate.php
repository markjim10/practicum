<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ExamDate extends Model
{
    public $timestamps = false;

    public static function getAvailableDates()
    {
        return ExamDate::where('status', '!=', 'removed')
            ->where('exam_end', '>', Carbon::now())
            ->get();
    }

    public static function getApplicationDates($application)
    {
        return ExamDate::where('status', '!=', 'removed')
            ->where('exam_end', '>', Carbon::now())
            ->orderBy('exam_date', 'asc')
            ->where('exam_type', $application)->get();
    }

    public static function isDatePassed()
    {

        $applicant = Applicant::where('user_id', Auth::user()->id)->first();
        $isDatePassed = "";

        $app = DB::table('applicants')
            ->join('app_results', 'applicants.id', '=', 'app_results.applicant_id')
            ->where('applicants.id', '=', $applicant->id)
            ->first();

        $yourExam = ExamDate::where('id', $app->exam_date)->first();

        $start = $yourExam->exam_start;
        $start = Carbon::parse($start);
        $end = $yourExam->exam_end;
        $end = Carbon::parse($end);
        $now = Carbon::now();
        $isDatePassed = json_encode($now->greaterThan($end));

        return $isDatePassed;
    }
}
