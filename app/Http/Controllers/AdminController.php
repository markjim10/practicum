<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use App\Trails;
use App\Subject;
use App\ExamDate;
use App\Feedback;
use App\Applicant;
use App\AppResult;
use App\UserAdmin;
use App\AppExamResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $arrDates = array();
        $arrCounts = array();

        $examDates = ExamDate::orderBy('exam_date', 'ASC')->get();
        $appResults = AppResult::all();
        foreach ($examDates as $date) {
            $count = 0;
            array_push($arrDates, $date->exam_date);
            foreach ($appResults as $app) {
                if ($app->exam_date == $date->id) {
                    $count++;
                }
            }
            array_push($arrCounts, $count);
        }

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
                    'average' => number_format($scores, 2, '.', ''),
                    'num_questions' => $subject->num_questions
                ]);
            }
        }

        $appResults = AppResult::where('exam_result', 'passed')->get();
        $passers = [];

        foreach ($appResults as $item) {
            $app = Applicant::where('id', $item->applicant_id)->first();
            $name = $app->first_name . " " . $app->last_name;
            $examDate = ExamDate::where('id', $item->exam_date)->first();
            $dateExam = $examDate->exam_date;
            array_push($passers, (object)[
                'name' => $name,
                'average' => number_format($item->exam_score * 100, 2, '.', ''),
                'dateExam' => $dateExam
            ]);
        }

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

        $passed = AppResult::where('exam_result', 'passed')->count();
        $failed = AppResult::where('exam_result', 'failed')->count();

        $arrPrograms = array();
        $arrProgramsCount = array();

        $appPrograms = Admin::getAppPrograms();
        foreach ($appPrograms as $app) {
            array_push($arrPrograms, $app->program_id);
            array_push($arrProgramsCount, $app->total);
        }

        $admin = UserAdmin::where('user_id', Auth::user()->id)->first();

        return view(
            'admins.index',
            compact(
                'arrDates',
                'arrCounts',
                'arrPrograms',
                'arrProgramsCount',
                'passed',
                'failed',
                'exams_results',
                'passers',
                'schoolsPassing',
                'admin'
            )
        );
    }

    public function applicants()
    {
        $applicants = Applicant::all();
        return view('admins.applicants.applicants_home', compact('applicants'));
    }

    public function applicants_edit($id)
    {
        $app = Applicant::where('id', $id)->first();
        return view('admins.applicants.applicants_edit', compact('app'));
    }

    public function applicants_status($status, $id)
    {
        $appResult = AppResult::where('applicant_id', $id)->first();
        $appResult->status = $status;
        $appResult->save();

        $applicant = Applicant::where('id', $id)->first();
        $user = User::where('id', $applicant->user_id)->first();
        $user->password = Hash::make('changeme');
        $user->save();

        if ($status == "approved") {
            Mail::raw([], function ($message) use ($user) {
                $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
                $message->to($user->email);
                $message->subject('Your application in the OJT 2 Project entrance exam has been approved');
                $message->setBody('<h2>You have been approved and can now log in your account by using your email address, and "changeme" for your password.</h2>', 'text/html');
            });
        } else {
            Mail::raw([], function ($message) use ($user) {
                $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
                $message->to($user->email);
                $message->subject('Your application in the OJT 2 Project entrance exam has been denied');
                $message->setBody('<h2>Sorry you have been denied.</h2>', 'text/html');
            });
        }

        $trail = "Updated applicant \"" .  $user->email . "\" to " . $status;
        Trails::saveTrails($trail);
        return redirect()->back()->with('message', 'applicant updated.');
    }

    public function feedbacks()
    {
        $feedbacks = Feedback::all();
        return view('admins.feedbacks', compact('feedbacks'));
    }

    public function remove_feedback($id)
    {
        Feedback::where('id', $id)->delete();
        $this->saveTrail("Deleted Feedback");
        return redirect()->back()->with('message', 'Feedback removed.');
    }
}
