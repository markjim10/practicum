<?php

namespace App\Http\Controllers;

use App\AppExamResult;
use App\User;
use App\Trails;
use App\Feedback;
use App\Applicant;
use App\ApplicantExam;
use App\AppResult;
use App\Services\DashboardService;
use Illuminate\Support\Facades\DB;
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
        $applicants = DB::table('applicants')->get();
        return view('admins.applicants', compact('applicants'));
    }

    public function selectApplicantsByStatus($status)
    {
        $applicants = $this->dashboardService->selectApplicantsByStatus($status);
        return $applicants;
    }

    public function applicants_edit($id)
    {
        $app = Applicant::where('id', $id)->first();
        return view('admins.applicants_edit', compact('app'));
    }

    public function applicants_status($status, $id)
    {
        $applicant = Applicant::where('id', $id)->first();
        $applicant->status = $status;
        $applicant->save();

        $appExam = new ApplicantExam();
        $appExam->applicant_id = $id;
        $appExam->save();

        $user = User::where('id', $id)->first();
        $user->password = Hash::make('changeme');
        $user->save();

        // if ($status == "approved") {
        //     Mail::raw([], function ($message) use ($user) {
        //         $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
        //         $message->to($user->email);
        //         $message->subject('Your application in the OJT 2 Project entrance exam has been approved');
        //         $message->setBody('<h2>You have been approved and can now log in your account by using your email address, and "changeme" for your password.</h2>', 'text/html');
        //     });
        // } else {
        //     Mail::raw([], function ($message) use ($user) {
        //         $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
        //         $message->to($user->email);
        //         $message->subject('Your application in the OJT 2 Project entrance exam has been denied');
        //         $message->setBody('<h2>Sorry you have been denied.</h2>', 'text/html');
        //     });
        // }

        $trail = "Updated applicant \"" .  $user->email . "\" to " . $status;
        Trails::saveTrails($trail);

        return redirect()->back()->with('message', 'Applicant Updated.');
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
