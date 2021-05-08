<?php

namespace App\Services;

use App\Exam;
use stdClass;
use App\Choice;
use App\Trails;
use App\Subject;
use App\Question;
use Carbon\Carbon;
use App\ApplicantExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $isDatePassed = "";
        // $isExamLive = "";
        // $yourExam = ExamDate::where('id', $app->appResult->exam_date)->first();
        // if ($yourExam != null) {
        //     $start = $yourExam->exam_start;
        //     $start = Carbon::parse($start);
        //     $end = $yourExam->exam_end;
        //     $end = Carbon::parse($end);
        //     $now = Carbon::now();
        //     $isDatePassed = json_encode($now->greaterThan($end));
        //     $isExamLive = json_encode(Carbon::now()->between($start, $end));
        // }
    }
}
