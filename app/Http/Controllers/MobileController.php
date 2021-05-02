<?php

namespace App\Http\Controllers;

use App\User;
use App\Word;
use App\Choice;
use App\Program;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    public function mobile_home(Request $request)
    {
        $user_id = request('user_id');
        $isDatePassed = "";
        $isExamLive = "";

        $app = DB::table('applicants')
            ->join('app_results', 'applicants.user_id', '=', 'app_results.user_id')
            ->where('applicants.user_id', '=', $user_id)
            ->first();

        $examdates = ExamDate::where('status', '!=', 'removed')
            ->where('exam_end', '>', Carbon::now())
            ->where('exam_type', $app->application)
            ->orderBy('exam_date', 'asc')
            ->get();

        $yourExam = ExamDate::where('id', $app->exam_date)->first();

        if ($yourExam != null) {
            $start = $yourExam->exam_start;
            $start = Carbon::parse($start);
            $end = $yourExam->exam_end;
            $end = Carbon::parse($end);
            $now = Carbon::now();
            $isDatePassed = json_encode($now->greaterThan($end));
            $isExamLive = json_encode(Carbon::now()->between($start, $end));
        }

        $response = [];
        array_push($response, (object)[
            'app' => $app,
            'examdates' => $examdates,
            'yourExam' => $yourExam,
            'isExamLive' => $isExamLive,
            'isDatePassed' => $isDatePassed,
        ]);

        return $response;
    }

    public function mobile_select_date(Request $request)
    {
        $user_id = request('user_id');

        $app = AppResult::where('user_id', $user_id)->first();
        $app->exam_date = request('date_id');
        $app->save();

        return "Date Selected";
    }


    public function mobile_login(Request $request)
    {
        $email = request('email');
        $password = request('password');

        $user = User::where('email', $email)->where('role', 'applicant')->first();

        if ($user == NULL || Hash::check($password, $user->password) == false) {
            return "Invalid Credentials";
        } else {
            $applicant = Applicant::where('user_id', $user->id)->first();
            return json_encode($applicant);
        }
    }

    public function mobile_chat(Request $request)
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

    public function mobile_exam_live(Request $request)
    {
        $user_id = request('user_id');

        $appResult = AppResult::where('user_id', $user_id)->first();
        $appResult->time_start = Carbon::now();
        $appResult->save();

        $app = DB::table('applicants')
            ->join('app_results', 'applicants.user_id', '=', 'app_results.user_id')
            ->where('applicants.user_id', '=', $user_id)
            ->first();

        $yourExam = ExamDate::where('id', $app->exam_date)->first();
        $start = $yourExam->exam_start;
        $start = Carbon::parse($start);
        $end = $yourExam->exam_end;
        $end = Carbon::parse($end);
        $now = Carbon::now();
        $isDatePassed = json_encode($now->greaterThan($end));
        $isExamLive = json_encode(Carbon::now()->between($start, $end));
        $secs = $end->diffInSeconds($now);

        $yourExam = ExamDate::where('id', $app->exam_date)->first();

        $exam_id = $yourExam->exam_id;

        $subjects = Exam_Subject::where('exam_id', $exam_id)->get();


        $subjects =  DB::table('exam__subjects')
            ->leftjoin('subjects', 'exam__subjects.subject_id', '=', 'subjects.id')
            ->where('exam__subjects.exam_id', '=', $exam_id)
            ->get();

        $arrQuestions = [];
        $arrChoices = [];
        $numQuestions = 0;

        foreach ($subjects as $subject) {
            $numQuestions += $subject->num_questions;
            $questions = Question::where('subject_id', $subject->id)->get();
            foreach ($questions as $question) {

                array_push($arrQuestions, (object)[
                    'id' => $question->id,
                    'question' => $question->question,
                ]);

                $choices = Choice::where('question_id', $question->id)
                    ->inRandomOrder()
                    ->get();
                foreach ($choices as $choice) {
                    array_push($arrChoices, (object)[
                        'id' => $choice->id,
                        'question_id' => $choice->question_id,
                        'choice' => $choice->choice,
                    ]);
                }
            }
        }

        $response = [];
        array_push($response, (object)[
            'secs' => $secs,
            'subjects' => $subjects,
            'questions' => $arrQuestions,
            'choices' => $arrChoices,
            'numQuestions' => $numQuestions,
        ]);

        return $response;
    }

    public function mobile_exam_submit(Request $request)
    {
        $user_id = request('user_id');
        $q = request('questions');
        $a = request('answer');

        $subjectFailed = false;

        $correct = 0;
        $a = chop($a, ",");
        $a = explode(',', $a);

        $q = str_replace("[", "", $q);
        $q = str_replace("]", "", $q);
        $q = str_replace(",", "", $q);
        $q = explode(' ', $q);

        $app = AppResult::where('user_id', $user_id)->first();
        $yourExam = ExamDate::where('id', $app->exam_date)->first();
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
                if ($question->id == $q[$i]) {
                    if ($question->answer == $a[$i]) {
                        $correct++;
                        $subj_correct++;
                    }
                }
                $i++;
            }

            $appExam = new AppExamResult();
            $appExam->user_id = $user_id;
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

        $score = $correct / count($q);

        if ($subjectFailed) {
            $result = "failed";
        } else {
            $result = "passed";
        }

        $app = AppResult::where('user_id', $user_id)->first();
        $app->exam_score = $score;
        $app->exam_result = $result;
        $app->time_end = Carbon::now();
        $app->save();

        return $score;
    }

    public function mobile_exam_results(Request $request)
    {
        $id = $request->user_id;
        $app = Applicant::where('user_id', $id)->first();
        $appResult = AppResult::where('user_id', $id)->first();

        $appExamResult = AppExamResult::where('user_id', $id)->get();
        $results = DB::table('subjects')
            ->select('subjects.*', 'app_exam_results.score', 'app_exam_results.result')
            ->leftjoin('app_exam_results', 'subjects.id', '=', 'app_exam_results.subject_id')
            ->leftjoin('applicants', 'applicants.user_id', '=', 'app_exam_results.user_id')
            ->where('subjects.status', '!=', 'pending')
            ->where('applicants.user_id', '=', $id)
            ->get();

        $end = new Carbon($appResult->time_end);
        $start = new Carbon($appResult->time_start);

        $totalDuration = $end->diffInSeconds($start);

        $dateExam = ExamDate::where('id', $appResult->exam_date)->first();
        $dateExam = $dateExam->exam_date;

        $end = Carbon::parse($end)->format('g:i:s a');
        $start = Carbon::parse($start)->format('g:i:s a');

        $totalDuration = gmdate('H:i:s', $totalDuration);

        $ArrResults = [];
        array_push($ArrResults, (object)[
            'app' => $app,
            'results' => $results,
            'appResult' => $appResult,
            'totalDuration' => $totalDuration,
            'end' => $end,
            'start' => $start,
            'dateExam' => $dateExam,
        ]);

        return $ArrResults;
    }

    public function getProvinces(Request $request)
    {
        $provinces = DB::table('philippine_provinces')->orderBy('province_description', 'asc')->get();
        return $provinces;
    }

    public function getCities(Request $request)
    {
        $id = request('province');
        $cities = DB::table('philippine_cities')->where('province_code', $id)->get();
        return $cities;
    }

    public function getPrograms(Request $request)
    {
        $id = $request->application;

        if ($id == "College") {
            $programs = Program::where('department', '!=', 'shs')->get();
        } else {
            $programs = Program::where('department', '=', 'shs')->get();
        }
        return $programs;
    }

    public function mobile_register(Request $request)
    {
        $email = request('email');
        $password = request('password');
        $dateOfBirth = request('date_of_birth');
        $province = request('province');

        $checkEmail = User::where('email', $email)->first();
        if ($checkEmail != null) {
            return "The email you entered is already taken";
        }

        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = 'applicant';
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
        $applicant->preferred_program = request('preferred_program');
        $applicant->school_last_attended = request('school_last_attended');
        $applicant->applicant_photo = request('photo');
        $applicant->card_photo = request('photo2');
        $applicant->save();

        $appResult = new AppResult();
        $appResult->user_id = $foreign;
        $appResult->save();
    }
}
