<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Choice;
use App\Subject;
use App\ExamDate;
use App\Question;
use App\Services\ExaminationService;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    protected $examinationService;

    public function __construct(ExaminationService $examinationService)
    {
        $this->examinationService = $examinationService;
        $this->middleware('admin');
    }

    public function create()
    {
        $subjects = Subject::where('status', '!=', 'removed')->get();
        $dates = ExamDate::getAvailableDates();
        $exams = Exam::all();

        return view('admins.examination', compact('subjects', 'dates', 'exams'));
    }

    public function create_exam(Request $request)
    {
        $subject = $request->subject;

        if ($subject == null) {
            return redirect()->back()->with('errors', 'You need select some subjects for the Exam.');
        } else {
            if (Exam::createExam($request)) {
                return redirect()->back()->with('success', 'Successfully created an exam.');
            } else {
                return redirect()->back()->with('errors', 'Exam name is unavailable.');
            }
        }
    }

    public function remove_exam($id)
    {
        Exam::removeExam($id);
    }

    public function store_exam_date(Request $request)
    {
        if (Exam::createExamDate($request)) {
            return redirect()->back()
                ->with('success', 'Successfully created an Examination Date.');
        } else {
            return redirect()->back()
                ->with('errors', 'The date you entered had already passed.');
        }
    }

    public function subjects($id)
    {
        $subject = Subject::where('id', $id)->first();
        $questions = Question::where('subject_id', $id)->orderBy('id', 'ASC')->get();
        $choices = Choice::where('subject_id', $id)->orderBy('id', 'ASC')->get();
        return view('admins.exams.subject_show', compact('subject', 'questions', 'choices'));
    }

    public function update_subject($data)
    {
        return Subject::updateSubject(json_decode($data));
    }

    public function subject_remove($id)
    {
        Subject::removeSubject($id);
    }

    //-- Exam Preview

    public function preview($id)
    {
        $subjects = Exam::getExamSubjects($id);
        $questions = Exam::getExamQuestions($subjects);
        $choices = Exam::getExamChoices($subjects);
        $exam = Exam::where('id', $id)->first();

        return view('admins.exams.preview', compact(
            'exam',
            'subjects',
            'questions',
            'choices'
        ));
    }
}
