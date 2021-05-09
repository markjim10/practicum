<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamDate;
use App\Question;
use App\Applicant;
use App\ApplicantExam;
use Carbon\Carbon;
use App\TempAnswer;
use App\ApplicantSubject;
use App\Services\ExaminationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    protected $examinationService;
    protected $exam;

    public function __construct(ExaminationService $examinationService, Exam $exam)
    {
        $this->middleware('applicant');
        $this->examinationService = $examinationService;
        $this->exam = $exam;
    }

    public function index()
    {
        $id = Auth::user()->id;
        $app = Applicant::where('user_id', $id)->first();
        $exams = $this->examinationService->getAvailableExams($app->application);
        $yourExam = $this->examinationService->yourExam($app->id);

        $isDatePassed = "";
        $isExamLive = "";

        if ($yourExam != null) {
            $start = Carbon::parse($yourExam->exam_start);
            $end = Carbon::parse($yourExam->exam_end);
            $now = Carbon::now();
            $isDatePassed = $now->greaterThan($end);
            $isExamLive = $now->between($start, $end);
        }

        return view('applicants.index', compact(
            'app',
            'exams',
            'yourExam',
            'isDatePassed',
            'isExamLive'
        ));
    }

    public function profile()
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        return view('applicants.profile', compact('app'));
    }

    public function select_date(Request $request)
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        $applicantExam = ApplicantExam::where('applicant_id', $app->id)->first();
        $applicantExam->exam_id = $request->exam_id;
        $applicantExam->save();

        return redirect()->back();
    }

    public function exam_live()
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        $applicantExam = ApplicantExam::where('applicant_id', $app->id)->first();

        if ($applicantExam->time_start == "pending") {
            $applicantExam->time_start = Carbon::now();
            $applicantExam->save();
        }

        $yourExam = $this->examinationService->yourExam($app->id);

        $isDatePassed = "";
        $isExamLive = "";

        if ($yourExam != null) {
            $start = Carbon::parse($yourExam->exam_start);
            $end = Carbon::parse($yourExam->exam_end);
            $now = Carbon::now();
            $isDatePassed = $now->greaterThan($end);
            $isExamLive = $now->between($start, $end);
            $secs = $end->diffInSeconds($now);
        }

        if ($isExamLive == false) {
            return redirect()->action('ApplicantController@index');
        }

        $subjects = $this->exam->getExamSubjects($yourExam->id);
        $questions = $this->exam->getExamQuestions($subjects);
        $choices = $this->exam->getExamChoices($questions);

        $answers = TempAnswer::where('applicant_id', $app->id);
        if ($answers->count() == 0) {
            foreach ($questions as $item) {
                $temp = new TempAnswer();
                $temp->applicant_id =  $app->id;
                $temp->question_id = $item->id;
                $temp->save();
            }
        }

        $questions = DB::table('questions')
            ->select('questions.*', 'temp_answers.temp_answer')
            ->leftjoin('temp_answers', 'questions.id', '=', 'temp_answers.question_id')
            ->leftjoin('subjects', 'subjects.id', '=', 'questions.subject_id')
            ->where('temp_answers.applicant_id', '=', $app->id)
            ->inRandomOrder()->get();

        return view('applicants.exam_live', compact(
            'app',
            'yourExam',
            'isDatePassed',
            'secs',
            'subjects',
            'questions',
            'choices'
        ));
    }

    public function update_temp_answer(Request $request)
    {
        TempAnswer::update_temp_answer($request);
        return 'saved temp answer';
    }

    public function isDatePassed()
    {
        return $this->examinationService->isDatePassed();
        return ExamDate::isDatePassed();
    }

    public function exam_submit(Request $request)
    {
        $questionID = $request->question_id;

        $correct = 0;
        $total = count($questionID);

        $subjectFailed = false;

        $applicant = Applicant::where('id', $request->id)->first();

        $applicantExam = ApplicantExam::where('applicant_id', $request->id)->first();

        $exam = Exam::where('id', $applicantExam->exam_id)->first();
        $exam->total_examinees = $exam->total_examinees + 1;
        $exam->save();

        $subjects =  DB::table('exam_subjects')
            ->join('subjects', 'exam_subjects.subject_id', '=', 'subjects.id')
            ->where('exam_subjects.exam_id', '=', $exam->id)
            ->get();

        $i = 0;

        foreach ($subjects as $subj) {
            $questions = Question::where('subject_id', $subj->id)->get();
            $subj_correct = 0;
            $subj_total_questions = count($questions);

            foreach ($questions as $question) {
                $answer = TempAnswer::where('question_id', $question->id)
                    ->where('applicant_id', $applicant->id)
                    ->first();

                if ($question->answer == $answer->temp_answer) {
                    $correct++;
                    $subj_correct++;
                }
                $i++;
            }

            $score = $subj_correct / $subj_total_questions;

            $appSubj = new ApplicantSubject();
            $appSubj->applicant_id = $applicant->id;
            $appSubj->subject_id = $subj->id;
            $appSubj->score = $score;

            if ($score >= 0.6) {
                $appSubj->result = "passed";
            } else {
                $appSubj->result = "failed";
                $subjectFailed = true;
            }

            $appSubj->save();
        }

        if ($subjectFailed) {
            $result = "failed";
        } else {
            $result = "passed";
        }

        $score = $correct / $total;

        $app = ApplicantExam::where('applicant_id', $applicant->id)->first();
        $app->exam_score = $score;
        $app->exam_result = $result;
        $app->time_end = Carbon::now();
        $app->save();

        return redirect()->action('ApplicantController@index');
    }

    public function exam_results()
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        $applicantExam = ApplicantExam::where('applicant_id', $app->id)->first();

        if ($applicantExam->exam_result == "pending") {
            return redirect()->route('applicants')
                ->with('message', 'You have not yet taken the exam');
        }

        $appExam = ApplicantExam::where('applicant_id', $app->id)->first();

        $applicant = DB::table('applicants')
            ->join('applicant_exams', 'applicant_exams.applicant_id', 'applicants.id')
            ->join('exams', 'exams.id', 'applicant_exams.exam_id')
            ->where('applicants.id', '=', $app->id)
            ->first();

        $subjects = DB::table('subjects')
            ->select(
                'subjects.*',
                'applicant_subjects.*'
            )
            ->join('applicant_subjects', 'applicant_subjects.subject_id', 'subjects.id')
            ->join('applicants', 'applicants.id', 'applicant_subjects.applicant_id')
            ->where('applicants.id', $app->id)
            ->get();


        return view('applicants.exam_results', compact(
            'applicant',
            'subjects'
        ));
    }
}
