<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Subject;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ExaminationService;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->middleware('admin');
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->subject->createSubject($request);
        return redirect()->back()->with('message', 'Successfully created a subject.');
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        $subject = Subject::where('id', $id)->first();
        $questions = Question::where('subject_id', $id)->orderBy('id', 'ASC')->get();
        $choices = $this->subject->getChoicesByQuestionId($questions);

        return view('subjects.edit', compact('subject', 'questions', 'choices'));
    }

    public function update(Request $request, $id)
    {
        return $this->subject->update_subject($request, $id);
    }

    public function remove($id)
    {
        return $this->subject->remove_subject($id);
    }

    public function destroy($id)
    {
        //
    }
}
