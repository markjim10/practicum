<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Word;
use App\Choice;
use App\ExamDate;
use App\Question;
use App\Response;
use App\Applicant;
use App\AppResult;
use Carbon\Carbon;
use App\Exam_Subject;
use App\AppExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AndroidController extends Controller
{
    public function index(Request $request)
    {
        $app = Applicant::where('user_id', $request->user_id)->first();
        $examdates = ExamDate::getApplicationDates($app->application);

        $isDatePassed = "";
        $isExamLive = "";
        $exam_start = "";
        $exam_end = "";
        $yourExamDate = "";

        $yourExam = ExamDate::where('id', $app->appResult->exam_date)->first();
        if ($yourExam != null) {
            $start = $yourExam->exam_start;
            $start = Carbon::parse($start);
            $end = $yourExam->exam_end;
            $end = Carbon::parse($end);
            $now = Carbon::now();
            $isDatePassed = json_encode($now->greaterThan($end));
            $isExamLive = json_encode(Carbon::now()->between($start, $end));
            $yourExamDate = $yourExam->exam_date;
            $exam_start = $start->format('g:i A');
            $exam_end = $end->format('g:i A');
        }

        $response = [];
        array_push($response, (object)[
            'app' => $app,
            'status' => $app->appResult->status,
            'exam_result' => $app->appResult->exam_result,
            'exam_date' => $app->appResult->exam_date,
            'examdates' => $examdates,
            'yourExam' => $yourExam,
            'yourExamDate' => $yourExamDate,
            'exam_start' => $exam_start,
            'exam_end' => $exam_end,
            'isExamLive' => $isExamLive,
            'isDatePassed' => $isDatePassed,
        ]);

        return $response;
    }

    public function login(Request $request)
    {
        $email = request('email');
        $password = request('password');

        $user = User::where('email', $email)->where('role', 'applicant')->first();

        if ($user == NULL || Hash::check($password, $user->password) == false) {
            return response()->json(['error' => 'Not authorized.'], 403);
        } else {
            $applicant = Applicant::where('user_id', $user->id)->first();
            return $applicant;
        }
    }

    public function register(Request $request)
    {
        $email = request('email_address');
        $user = User::where('email', $email)->first();
        if ($user) {
            return "Email is unavailable";
        }

        $email = request('email_address');
        $password = Hash::make('password');
        $dateOfBirth = request('date_of_birth');
        $province = DB::table('philippine_provinces')
            ->where('province_code', request('province'))
            ->value('province_description');

        $user = new User();
        $user->email = $email;
        $user->username = $email;
        $user->password = $password;
        $user->role = 'applicant';
        $user->photo = request('photo');
        $user->save();

        $foreign = $user->id;
        $applicant = new Applicant();
        $applicant->user_id = $foreign;
        $applicant->first_name = request('first_name');
        $applicant->last_name = request('last_name');
        $applicant->middle_name = request('middle_name');
        $applicant->province = $province;
        $applicant->city = request('city');
        $applicant->brgy = request('brgy');
        $applicant->phone = request('phone');
        $applicant->date_of_birth = $dateOfBirth;
        $applicant->application = request('application');
        $applicant->program_id = request('preferred_program');
        $applicant->school_last_attended = request('school_last_attended');
        $applicant->card_photo = request('card_photo');

        $applicant->save();

        $appResult = new AppResult();
        $appResult->applicant_id = $applicant->id;
        $appResult->save();
    }

    public function select_date(Request $request)
    {
        $app = Applicant::where('user_id', $request->user_id)->first();
        $appResult = AppResult::where('applicant_id', $app->id)->first();
        $appResult->exam_date = $request->date_id;
        $appResult->save();
        return redirect()->action('ApplicantController@index');
    }

    public function exam_live(Request $request)
    {
        $app = Applicant::where('user_id', $request->id)->first();
        $appResult = AppResult::where('applicant_id', $app->id)->first();

        if ($appResult->time_start == "pending") {
            $appResult->time_start = Carbon::now();
            $appResult->save();
        }

        $yourExam = ExamDate::where('id', $app->appResult->exam_date)->first();
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

        $arrQuestions = [];
        foreach ($subjects as $subject) {

            $questions = Question::where('subject_id', $subject->id)
                ->inRandomOrder()
                ->get(['id', 'question']);

            foreach ($questions as $question) {
                $choices = Choice::where('question_id', $question->id)->inRandomOrder()->get(['choice']);
                array_push($arrQuestions, (object)[
                    'id' => $question->id,
                    'question' => $question->question,
                    'choices' => $choices
                ]);
            }
        }

        $response = [];
        array_push($response, (object)[
            'user_id' => $app->user_id,
            'yourExam' => $yourExam,
            'isDatePassed' => $isDatePassed,
            'secs' => $secs,
            'subjects' => $subjects,
            'questions' => $arrQuestions,
        ]);

        return $response;
    }

    public function submit(Request $request)
    {
        $user_id = $request->user_id;
        $questionsId = json_decode($request->questions);
        $answers = json_decode($request->answers, true);

        $subjectFailed = false;
        $total = count($questionsId);
        $correct = 0;

        $applicant = Applicant::where('user_id', $user_id)->first();
        $appResult = AppResult::where('applicant_id', $applicant->id)->first();
        $yourExam = ExamDate::where('id', $appResult->exam_date)->first();
        $subjects = Exam_Subject::where('exam_id', $yourExam->exam_id)->get();

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
                for ($j = 0; $j < count($questionsId); $j++) {
                    if ($question->id == $questionsId[$j]) {
                        if ($question->answer == $answers[$j]) {
                            $correct++;
                            $subj_correct++;
                        }
                        break;
                    }
                }
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

        $app = AppResult::where('applicant_id', $applicant->id)->first();
        $app->exam_score = $score;
        $app->exam_result = $result;
        $app->time_end = Carbon::now();
        $app->save();

        return $correct;
    }

    public function result(Request $request)
    {
        $app = Applicant::where('user_id', $request->user_id)->first();
        $appResult = AppResult::where('applicant_id', $app->id)->first();

        if ($appResult->exam_result == "pending") {
            return view('applicants.exam_results', compact('app', 'appResult'));
        }

        $appExamResult = AppExamResult::where('applicant_id', $app->id)->get();
        $results = DB::table('subjects')
            ->select('subjects.*', 'app_exam_results.score', 'app_exam_results.result')
            ->leftjoin('app_exam_results', 'subjects.id', '=', 'app_exam_results.subject_id')
            ->leftjoin('applicants', 'applicants.id', '=', 'app_exam_results.applicant_id')
            ->where('subjects.status', '!=', 'pending')
            ->where('applicants.id', '=', $app->id)
            ->get();

        $end = new Carbon($appResult->time_end);
        $start = new Carbon($appResult->time_start);

        $totalDuration = $end->diffInSeconds($start);

        $dateExam = ExamDate::where('id', $appResult->exam_date)->first();
        $dateExam = $dateExam->exam_date;

        $end = Carbon::parse($end)->format('g:i:s a');
        $start = Carbon::parse($start)->format('g:i:s a');

        $totalDuration = gmdate('H:i:s', $totalDuration);

        $response = [];
        array_push($response, (object)[
            'app' => $app,
            'results' => $results,
            'appResult' => $appResult,
            'totalDuration' => $totalDuration,
            'end' => $end,
            'start' => $start,
            'dateExam' => $dateExam,
        ]);

        return $response;
    }

    public function chat(Request $request)
    {
        $message = request('message');
        $arrMsg = explode(" ", strtolower($message));
        $count = sizeof($arrMsg);
        $words = Word::all();
        if ($count < 3) {
            return "Too short";
        } else {
            $res = array();
            foreach ($words as $word) {
                for ($i = 0; $i < $count; $i++) {
                    if ($arrMsg[$i] == $word->word) {
                        array_push($res, $word->response_id);
                    }
                }
            }

            if (!empty($res)) {
                $correct = 0;
                $c = array_count_values($res);
                $val = array_search(max($c), $c);
                $response = Response::where('id', $val)->first();

                $words = Word::where('response_id', $response->id)->get();

                foreach ($words as $word) {
                    for ($i = 0; $i < $count; $i++) {
                        if ($arrMsg[$i] == $word->word) {
                            $correct++;
                        }
                    }
                }

                if ($correct < 3) {
                    $answer = 'please specify . . .';
                } else {
                    $answer = $response->response;
                }
            } else {
                $answer = 'not found . . .';
            }
            return $answer;
        }
    }
}
