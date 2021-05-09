<?php

namespace App\Http\Controllers;

use App\User;
use App\Trails;
use App\Applicant;
use App\ApplicantExam;
use App\Exam;
use App\Services\DashboardService;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $dashboardService;
    protected $registerService;

    public function __construct(DashboardService $dashboardService, RegisterService $registerService)
    {
        $this->middleware('admin');
        $this->dashboardService = $dashboardService;
        $this->registerService = $registerService;
    }

    public function index()
    {
        $schoolPassingRate = $this->dashboardService->schoolPassingRate();
        $passers = $this->dashboardService->passers();
        return view('admins.index', compact('schoolPassingRate', 'passers'));
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

        $this->registerService->sendMail($status);

        Trails::saveTrails("Updated applicant \"" .  $user->email . "\" to " . $status);

        return redirect()->back()->with('message', 'Applicant Updated.');
    }
}
