<?php

namespace App\Http\Controllers;

use App\Services\RegisterService;
use App\Services\DashboardService;
use Barryvdh\DomPDF\Facade as PDF;

class ReportsController extends Controller
{
    protected $dashboardService;
    protected $registerService;

    public function __construct(DashboardService $dashboardService, RegisterService $registerService)
    {
        $this->middleware('admin');
        $this->dashboardService = $dashboardService;
        $this->registerService = $registerService;
    }

    public function reports_programs()
    {
        $programs = $this->dashboardService->getPreferredPrograms();
        $date = date_create()->format('F d Y H:i A');
        $data = [
            'programs' => $programs,
            'date' => $date
        ];

        $pdf = PDF::loadView('reports.applicants', $data);
        return $pdf->download('applicants-preferred-courses.pdf');
    }

    // public function reports_exams()
    // {
    //     $exams_results = [];
    //     $subjects = Subject::all();

    //     foreach ($subjects as $subject) {
    //         $scores = 0;
    //         $results = AppExamResult::where('subject_id', $subject->id)->get();
    //         if ($results->count() > 0) {
    //             foreach ($results as $item) {
    //                 $scores += $item->score;
    //             }
    //             $scores = $scores / $results->count() * 100;
    //             array_push($exams_results, (object)[
    //                 'subject' => $subject->name,
    //                 'average' => $scores,
    //                 'num_questions' => $subject->num_questions
    //             ]);
    //         }
    //     }

    //     $date = date_create()->format('F d Y H:i A');
    //     $data = [
    //         'exams_results' => $exams_results,
    //         'date' => $date
    //     ];

    //     $pdf = PDF::loadView('reports.exams', $data);
    //     return $pdf->download('exams.pdf');
    // }

    public function reports_passers()
    {
        $passers = $this->dashboardService->passers();

        $date = date_create()->format('F d Y H:i A');
        $data = [
            'passers' => $passers,
            'date' => $date
        ];

        $pdf = PDF::loadView('reports.passers', $data);
        return $pdf->download('passers.pdf');
    }

    public function reports_school_passing()
    {
        $schoolsPassing = $this->dashboardService->schoolPassingRate();
        $date = date_create()->format('F d Y H:i A');
        $data = ['schools' => $schoolsPassing, 'date' => $date];
        $pdf = PDF::loadView('reports.schools', $data);
        return $pdf->download('school-passing-rate.pdf');
    }
}
