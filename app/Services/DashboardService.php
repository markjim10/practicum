<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getPreferredPrograms()
    {
        return DB::table('applicants')
            ->join('programs', 'applicants.program_id', '=', 'programs.id')
            ->select('programs.program_id', DB::raw('count(*) as count'))
            ->groupBy('programs.program_id')
            ->get();
    }

    public function getApplicantsPassingRate()
    {
        return DB::table('app_exam_results')
            ->select('result', DB::raw('count(*) as count'))
            ->groupBy('result')
            ->get();
    }

    public function getExamDates()
    {
        return DB::table('exam_dates')
            ->get();
    }

    public function schoolPassingRate()
    {
        return DB::table('applicants')
            ->join('app_exam_results', 'applicants.id', '=', 'app_exam_results.applicant_id')
            ->select(
                'applicants.school_last_attended as school',
                DB::raw('count(case when app_exam_results.result = \'passed\' then 1 else null end) as passed'),
                DB::raw('count(case when app_exam_results.result = \'failed\' then 1 else null end) as failed'),
                DB::raw('count(app_exam_results.result) as total'),
                DB::raw('ROUND((count(case when app_exam_results.result = \'passed\' then 1 else null end)/count(app_exam_results.result))*100,0) as average')
            )
            ->groupBy('applicants.school_last_attended')
            ->orderByDesc('total')
            ->get();
    }

    public function passers()
    {
        return DB::table('app_exam_results')
            ->join('applicants', 'app_exam_results.applicant_id', '=', 'applicants.id')
            ->get();
    }

    public function selectApplicantsByStatus($status)
    {
        if ($status == 'total') {
            return DB::table('applicants')
                ->join('app_results', 'applicants.id', '=', 'app_results.applicant_id')
                ->get();
        } else if ($status == 'pending') {
        }
    }
}
