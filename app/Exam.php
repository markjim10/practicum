<?php

namespace App;

use Carbon\Carbon;
use App\ExamSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function create($request)
    {
        $exam = Exam::where('exam_name', $request->exam_name)->first();

        if ($exam) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'Exam name already selected'
                ]);
        }

        if ($request->subject == null) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'No subjects selected'
                ]);
        }

        $exam_start = $request->exam_date . " " . $request->exam_start;
        $exam_start = Carbon::parse($exam_start);
        $now = Carbon::now();

        $isDatePassed = Carbon::now()->greaterThan($exam_start);
        if ($isDatePassed == true) {
            return response()
                ->json([
                    'result' => 'error',
                    'message' => 'Date has passed'
                ]);
        }

        $exam_end = Carbon::parse($exam_start)->addMinutes($request->time_limit);

        $exam = new Exam();
        $exam->exam_name = $request->exam_name;
        $exam->exam_date = $request->exam_date;
        $exam->exam_type = $request->exam_type;
        $exam->exam_start = $exam_start->toDateTimeString();
        $exam->exam_end = $exam_end->toDateTimeString();;
        $exam->save();

        $subjects = $request->subject;
        foreach ($subjects as $subject) {
            $exam_subject = new ExamSubject();
            $exam_subject->exam_id = $exam->id;
            $exam_subject->subject_id = $subject;
            $exam_subject->save();
        }

        Trails::saveTrails("Created exam  \"" . $exam->exam_name . "\"");

        return response()
            ->json([
                'result' => 'success',
                'message' => 'Exam created successfully'
            ]);
    }

    public static function removeExam($id)
    {
    }

    public function getExamSubjects($id)
    {
        return  DB::table('exam_subjects')
            ->join('subjects', 'exam_subjects.subject_id', '=', 'subjects.id')
            ->where('exam_subjects.exam_id', '=', $id)
            ->get();
    }

    public static function getExamQuestions($subjects)
    {
        $arrQuestions = [];
        foreach ($subjects as $subject) {
            $questions = Question::where('subject_id', $subject->id)->inRandomOrder()->get();
            foreach ($questions as $question) {
                array_push($arrQuestions, (object)[
                    'id' => $question->id,
                    'subject_id' => $question->subject_id,
                    'question' => $question->question,
                    'answer' => $question->answer,
                ]);
            }
        }
        return $arrQuestions;
    }

    public function getExamChoices($questions)
    {
        $question_id = array();
        foreach ($questions as $question) {
            array_push($question_id, $question->id);
        }

        return Choice::whereIn('question_id', $question_id)->inRandomOrder()->get();
    }
}
