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
use App\Services\DashboardService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('admin');
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $schoolPassingRate = $this->dashboardService->schoolPassingRate();
        $passers = $this->dashboardService->passers();
        return view('admins.index', compact('schoolPassingRate'));
    }

    public function applicants()
    {
        $applicants = Applicant::all();
        return view('admins.applicants.applicants_home', compact('applicants'));
    }

    public function selectApplicantsByStatus($status)
    {
        $applicants = $this->dashboardService->selectApplicantsByStatus($status);
        return $applicants;
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
