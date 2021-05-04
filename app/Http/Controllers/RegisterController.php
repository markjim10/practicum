<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register()
    {
        $provinces = $this->registerService->getProvinces();
        $months = $this->registerService->getMonths();
        $programs = Program::all();

        return view('home.register_applicant', compact('programs', 'months', 'provinces'));
    }

    public function store(Request $request)
    {
        $this->registerService->registerApplicant($request);
        return redirect()->back()->with('message', 'You have been registered');
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
        return $this->registerService->validateEmail($email);
    }

    public function phone_validation($phone)
    {
        return $this->registerService->validatePhone($phone);
    }
}
