<?php

namespace App\Http\Controllers;

use App\User;
use App\Program;
use App\ExamDate;
use App\Applicant;
use App\AppResult;
use App\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('guest.index');
    }

    public function about()
    {
        return view('guest.about');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function get_city($id)
    {
        return DB::table('philippine_cities')->where('province_code', $id)->get();
    }

    public function get_application($id)
    {
        return Program::selectedApplication($id);
    }

    public function email_validation($email)
    {
        return Helper::validateEmail($email);
    }

    public function phone_validation($phone)
    {
        return Helper::validatePhone($phone);
    }

    public function register()
    {
        $provinces = DB::table('philippine_provinces')->orderBy('province_description', 'asc')->get();
        $months = Helper::getMonths();
        $programs = Program::all();

        return view('guest.register', compact('programs', 'months', 'provinces'));
    }

    public function store(Request $request)
    {
        Applicant::registerApplicant($request);

        Session::flash('success', "You have successfully registered, an email will be sent to you once you are approved.");

        return Redirect::back();
    }

    public function schedule()
    {
        $collegeSched = ExamDate::where('exam_type', 'college')->get();
        $shsSched = ExamDate::where('exam_type', 'shs')->get();

        return view('guest.schedule', compact('collegeSched', 'shsSched'));
    }

    public function programs()
    {
        $cas = Program::where('department', 'cas')->get();
        $ccis = Program::where('department', 'ccis')->get();
        $ety = Program::where('department', 'ety')->get();
        $mare = Program::where('department', 'mare')->get();
        $mitl = Program::where('department', 'mitl')->get();
        $shs = Program::where('department', 'shs')->get();
        return view('guest.programs', compact('cas', 'ccis', 'ety', 'mare', 'mitl', 'shs'));
    }

    public function chatbot()
    {
        return view('guest.chatbot');
    }
}
