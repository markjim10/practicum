<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Question;
use Illuminate\Http\Request;

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
        $subjects = Subject::where('status', '!=', 'removed')->get();
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
        $this->subject->remove_subject($id);
        return redirect('/subjects');
    }

    public function destroy($id)
    {
        //
    }
}
