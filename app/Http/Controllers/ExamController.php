<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Subject;
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
        $exams = Exam::all();

        return view('exams.index', compact('subjects', 'dates', 'exams'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response = $this->exam->create($request);
        $response = json_decode($response->getContent());
        return redirect()->back()->with($response->result, $response->message);
    }

    public function show($id)
    {
        $subjects = $this->exam->getExamSubjects($id);
        $questions = $this->exam->getExamQuestions($subjects);
        $choices = $this->exam->getExamChoices($questions);
        $exam = Exam::where('id', $id)->first();
        return view('exams.show', compact(
            'exam',
            'subjects',
            'questions',
            'choices'
        ));
    }
}
