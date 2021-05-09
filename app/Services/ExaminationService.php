<?php

namespace App\Services;

use App\Exam;
use stdClass;
use App\Choice;
use App\Trails;
use App\Subject;
use App\Question;
use App\Applicant;
use Carbon\Carbon;
use App\ApplicantExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExaminationService
{
    public function getAvailableExams($application)
    {
        return Exam::where('exam_end', '>', Carbon::now())
            ->orderBy('exam_date', 'asc')
            ->where('exam_type', $application)->get();
    }

    public function yourExam($id)
    {
        $exam = DB::table('applicant_exams')
            ->select('exams.id')
            ->join('exams', 'exams.id', '=', 'applicant_exams.exam_id')
            ->join('applicants', 'applicants.id', '=', 'applicant_exams.applicant_id')
            ->where('applicants.id', $id)
            ->first();

        if ($exam != null) {
            return Exam::where('id', $exam->id)->first();
        } else {
            return $exam;
        }
    }

    public function examStatus($yourExam)
    {
        $examStatus = new stdClass();

        $start = Carbon::parse($yourExam->exam_start);
        $end = Carbon::parse($yourExam->exam_end);
        $now = Carbon::now();

        $examStatus->isDatePassed = $now->greaterThan($end);
        $examStatus->isExamLive = $now->between($start, $end);

        return $examStatus;
    }

    public function isDatePassed()
    {
        $applicant = Applicant::where('user_id', Auth::user()->id)->first();

        $app = DB::table('applicants')
            ->select('applicant_exams.id')
            ->join('applicant_exams', 'applicant_exams.applicant_id', '=', 'applicants.id')
            ->where('applicants.id', '=', $applicant->id)
            ->first();

        $yourExam = Exam::where('id', $app->id)->first();
        $end = Carbon::parse($yourExam->exam_end);
        $now = Carbon::now();

        return json_encode($now->greaterThan($end));
    }
}
