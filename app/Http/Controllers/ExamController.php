<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Subject;
use App\ExamDate;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $exam;

    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
        $this->middleware('admin');
    }

    public function index()
    {
        $subjects = Subject::where('status', '!=', 'removed')->get();
        $dates = ExamDate::getAvailableDates();
        $exams = Exam::all();

        return view('exams.index', compact('subjects', 'dates', 'exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
