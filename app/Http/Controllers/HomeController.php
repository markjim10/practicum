<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Program;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function programs()
    {
        $cas = Program::where('department', 'cas')->get();
        $ccis = Program::where('department', 'ccis')->get();
        $ety = Program::where('department', 'ety')->get();
        $mare = Program::where('department', 'mare')->get();
        $mitl = Program::where('department', 'mitl')->get();
        $shs = Program::where('department', 'shs')->get();
        return view('home.programs', compact('cas', 'ccis', 'ety', 'mare', 'mitl', 'shs'));
    }

    public function schedule()
    {
        $collegeSched = Exam::where('exam_type', 'college')->get();
        $shsSched = Exam::where('exam_type', 'shs')->get();

        return view('home.schedule', compact('collegeSched', 'shsSched'));
    }

    public function chatbot()
    {
        return view('home.chatbot');
    }
}
