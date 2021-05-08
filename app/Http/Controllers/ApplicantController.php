<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamDate;
use App\Feedback;
use App\Question;
use App\Applicant;
use App\ApplicantExam;
use Carbon\Carbon;
use App\TempAnswer;
use App\Exam_Subject;
use App\AppExamResult;
use App\ExamSubject;
use App\Services\ExaminationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    protected $examinationService;

    public function __construct(ExaminationService $examinationService)
    {
        $this->middleware('applicant');
        $this->examinationService = $examinationService;
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

        // dd($app->applicantExam->exam_id . " " . $id);


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

        $yourExam = ExamDate::where('id', $app->applicantExam->exam_date)->first();
        $start = Carbon::parse($yourExam->exam_start);
        $end = Carbon::parse($yourExam->exam_end);
        $now = Carbon::now();
        $isDatePassed = json_encode($now->greaterThan($end));
        $isExamLive = json_encode(Carbon::now()->between($start, $end));
        $secs = $end->diffInSeconds($now);

        if ($isExamLive == "false") {
            return redirect()->action('ApplicantController@index');
        }

        $subjects = Exam::getExamSubjects($yourExam->exam_id);
        $questions = Exam::getExamQuestions($subjects);
        $choices = Exam::getExamChoices($subjects);

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
            ->where('subjects.status', '=', 'approved')
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

    public function update_temp_answer($data)
    {
        TempAnswer::update_temp_answer($data);
        return 'saved temp answer';
    }

    public function isDatePassed()
    {
        return ExamDate::isDatePassed();
    }

    public function exam_submit(Request $request)
    {
        $questionID = $request->question_id;

        $correct = 0;
        $total = count($questionID);

        $subjectFailed = false;

        $applicant = Applicant::where('user_id', Auth::user()->id)->first();

        $applicantExam = applicantExam::where('applicant_id', $applicant->id)->first();
        $yourExam = ExamDate::where('id', $applicantExam->exam_date)->first();
        $subjects = ExamSubject::where('exam_id', $yourExam->exam_id)->get();

        $subjects =  DB::table('exam__subjects')
            ->leftjoin('subjects', 'exam__subjects.subject_id', '=', 'subjects.id')
            ->where('exam__subjects.exam_id', '=', $yourExam->exam_id)
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

            $appExam = new AppExamResult();
            $appExam->applicant_id = $applicant->id;
            $appExam->subject_id = $subj->id;

            $appExamScore = $subj_correct / $subj_total_questions;
            $appExam->score = $appExamScore;

            if ($appExamScore >= 0.6) {
                $appExam->result = "passed";
            } else {
                $appExam->result = "failed";
                $subjectFailed = true;
            }
            $appExam->save();
        }

        if ($subjectFailed) {
            $result = "failed";
        } else {
            $result = "passed";
        }

        $score = $correct / $total;

        $app = applicantExam::where('applicant_id', $applicant->id)->first();
        $app->exam_score = $score;
        $app->exam_result = $result;
        $app->time_end = Carbon::now();
        $app->save();

        return redirect()->action('ApplicantController@index');
    }

    public function exam_results()
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        $applicantExam = applicantExam::where('applicant_id', $app->id)->first();

        if ($applicantExam->exam_result == "pending") {
            return view('applicants.exam_results', compact('app', 'applicantExam'));
        }

        $appExamResult = AppExamResult::where('applicant_id', $app->id)->get();
        $results = DB::table('subjects')
            ->select('subjects.*', 'app_exam_results.score', 'app_exam_results.result')
            ->leftjoin('app_exam_results', 'subjects.id', '=', 'app_exam_results.subject_id')
            ->leftjoin('applicants', 'applicants.id', '=', 'app_exam_results.applicant_id')
            ->where('subjects.status', '!=', 'pending')
            ->where('applicants.id', '=', $app->id)
            ->get();

        $end = new Carbon($applicantExam->time_end);
        $start = new Carbon($applicantExam->time_start);

        $totalDuration = $end->diffInSeconds($start);

        $dateExam = ExamDate::where('id', $applicantExam->exam_date)->first();
        $dateExam = $dateExam->exam_date;

        $end = Carbon::parse($end)->format('g:i:s a');
        $start = Carbon::parse($start)->format('g:i:s a');

        $totalDuration = gmdate('H:i:s', $totalDuration);

        return view('applicants.exam_results', compact(
            'app',
            'results',
            'applicantExam',
            'totalDuration',
            'end',
            'start',
            'dateExam'
        ));
    }

    public function store_feedback(Request $request)
    {
        Feedback::store_feedback($request);
        return redirect()->back()->with('message', 'Feedback has been sent');
    }

    public function send_feedback()
    {
        $app = Applicant::where('user_id', Auth::user()->id)->first();
        return view('applicants.send_feedback', compact('app'));
    }
}
