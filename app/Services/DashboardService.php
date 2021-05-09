<?php

namespace App\Services;

use App\Http\Middleware\Applicant;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getPreferredPrograms()
    {
        return DB::table('applicants')
            ->join('programs', 'applicants.program_id', '=', 'programs.id')
            ->select(
                'programs.program_id',
                'programs.program_name',
                DB::raw('count(*) as count')
            )
            ->groupBy('programs.program_id')
            ->get();
    }

    public function getApplicantsPassingRate()
    {
        return DB::table('applicant_exams')
            ->select('exam_result', DB::raw('count(*) as count'))
            ->groupBy('exam_result')
            ->get();
    }

    public function getExamDates()
    {
        return DB::table('exams')
            ->select('exam_date', 'total_examinees')
            ->groupBy('exam_date')
            ->get();
    }

    public function schoolPassingRate()
    {
        return DB::table('applicants')
            ->join('applicant_exams', 'applicants.id', '=', 'applicant_exams.applicant_id')
            ->select(
                'applicants.school_last_attended as school',
                DB::raw('count(case when applicant_exams.exam_result = \'passed\' then 1 else null end) as passed'),
                DB::raw('count(case when applicant_exams.exam_result = \'failed\' then 1 else null end) as failed'),
                DB::raw('count(applicant_exams.exam_result) as total'),
                DB::raw('ROUND((count(case when applicant_exams.exam_result = \'passed\' then 1 else null end)/count(applicant_exams.exam_result))*100,0) as average')
            )
            ->where('applicant_exams.exam_result', '!=', 'pending')
            ->groupBy('applicants.school_last_attended')
            ->get();
    }

    public function passers()
    {
        return DB::table('applicant_exams')
            ->select(
                DB::raw("CONCAT(applicants.first_name, ' ', applicants.last_name) AS name"),
                DB::raw('applicant_exams.exam_score * 100 as average'),
                'exams.exam_date as date'
            )
            ->join('applicants', 'applicant_exams.applicant_id', '=', 'applicants.id')
            ->join('exams', 'applicant_exams.exam_id', 'exams.id')
            ->where('applicant_exams.exam_result', 'passed')
            ->get();
    }

    public function selectApplicantsByStatus($status)
    {
        if ($status == 'total') {
            return DB::table('applicants')->get();
        }
        return DB::table('applicants')
            ->where('status', $status)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
