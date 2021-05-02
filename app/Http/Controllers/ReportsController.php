<?php

namespace App\Http\Controllers;

use App\Program;
use App\Subject;
use App\ExamDate;
use App\Applicant;
use App\AppResult;
use App\AppExamResult;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function programs_report()
    {
        $getPrograms = Program::all();

        $programs = [];
        foreach ($getPrograms as $program) {
            if ($program->applicantsCount() != 0) {
                array_push($programs, (object)[
                    'program' => $program->program_name,
                    'count' => $program->applicantsCount(),
                ]);
            }
        }

        $date = date_create()->format('F d Y H:i A');
        $data = [
            'programs' => $programs,
            'date' => $date
        ];

        $pdf = PDF::loadView('reports.applicants', $data);
        return $pdf->download('applicants-preferred-courses.pdf');
    }

    public function reports_exams()
    {
        $exams_results = [];
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            $scores = 0;
            $results = AppExamResult::where('subject_id', $subject->id)->get();
            if ($results->count() > 0) {
                foreach ($results as $item) {
                    $scores += $item->score;
                }
                $scores = $scores / $results->count() * 100;
                array_push($exams_results, (object)[
                    'subject' => $subject->name,
                    'average' => $scores,
                    'num_questions' => $subject->num_questions
                ]);
            }
        }

        $date = date_create()->format('F d Y H:i A');
        $data = [
            'exams_results' => $exams_results,
            'date' => $date
        ];

        $pdf = PDF::loadView('reports.exams', $data);
        return $pdf->download('exams.pdf');
    }

    public function reports_passers()
    {
        $passers = [];
        $applicants = Applicant::all();

        foreach ($applicants as $app) {

            if ($app->appResult->exam_result == "passed") {
                $examDate = ExamDate::where('id', $app->appResult->exam_date)->first();
                array_push($passers, (object)[
                    'name' => $app->first_name . " " . $app->last_name,
                    'average' => $app->appResult->exam_score * 100,
                    'dateExam' => $examDate->exam_date
                ]);
            }
        }

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
        $applicants = DB::table('applicants')
            ->select('school_last_attended')
            ->groupBy('school_last_attended')
            ->get();

        $schoolsPassing = [];
        foreach ($applicants as $app) {
            $total = 0;
            $passed = 0;
            $apps = Applicant::where('school_last_attended', $app->school_last_attended)->get();
            foreach ($apps as $a) {
                $here = AppExamResult::where('applicant_id', $a->id)
                    ->where('result', '!=', 'Pending')
                    ->get();

                if (!$here->isEmpty()) {
                    $ex = AppExamResult::where('applicant_id', $a->id)
                        ->where('result', 'failed')
                        ->get();

                    if ($ex->isEmpty()) {
                        $passed++;
                    }
                    $total++;
                }
            }

            if ($total != 0) {
                array_push($schoolsPassing, (object)[
                    'school' => $app->school_last_attended,
                    'pass' => $passed,
                    'total' => $total,
                    'passing' => round(($passed / $total) * 100, 2)
                ]);
            }
        }

        $c = collect($schoolsPassing);
        $sorted = $c->sortByDesc('passing');
        $schoolsPassing = $sorted;

        $date = date_create()->format('F d Y H:i A');
        $data = ['schools' => $schoolsPassing, 'date' => $date];
        $pdf = PDF::loadView('reports.schools', $data);
        return $pdf->download('school-passing-rate.pdf');
    }
}
