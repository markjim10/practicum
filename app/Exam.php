<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function date()
    {
        return $this->belongsTo(Date::class);
    }

    public static function createExam($request)
    {
        $exam = Exam::where('exam_name', $request->exam_name)->first();
        if ($exam) {
            return false;
        }

        $exam = new Exam();
        $exam->exam_name = $request->exam_name;
        $exam->save();

        $subj = $request->subject;

        foreach ($subj as $item) {
            $examSubj = new Exam_Subject();
            $examSubj->exam_id = $exam->id;
            $examSubj->subject_id = $item;
            $examSubj->save();
        }

        Trails::saveTrails("Created exam  \"" . $exam->exam_name . "\"");
        return true;
    }

    public static function removeExam($id)
    {
        // $exam = Exam::where('id', $id)->first();
        // $exam->delete();

        // $app = AppResult::where('exam_date', $id)->get();
        // $exam = Exam_Subject::where('id', $id)->first();
        // $date = ExamDate::where('exam_id', $id)->first();

        // return $date;
        // if ($date != null) {
        //     $date->status = "removed";
        //     $date->save();
        //     $app = AppResult::where('exam_date', $date->id)
        //         ->where('status', 'pending')
        //         ->get();

        //     if ($app->count() != 0) {
        //         foreach ($app as $item) {
        //             $item->exam_date = 0;
        //             $item->save();
        //         }
        //     }
        // }
        // Helper::saveTrails("Removed exam  " . $exam->exam_name);
        // return 'removed';
    }

    public static function getExamSubjects($id)
    {
        return  DB::table('exam__subjects')
            ->leftjoin('subjects', 'exam__subjects.subject_id', '=', 'subjects.id')
            ->where('exam__subjects.exam_id', '=', $id)
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

    public static function getExamChoices($subjects)
    {
        $arrChoices = [];
        foreach ($subjects as $subject) {
            $choices = Choice::where('subject_id', $subject->id)->inRandomOrder()->get();
            foreach ($choices as $choice) {
                array_push($arrChoices, (object)[
                    'id' => $choice->id,
                    'subject_id' => $choice->subject_id,
                    'question_id' => $choice->question_id,
                    'choice' => $choice->choice,
                ]);
            }
        }
        return $arrChoices;
    }

    public static function createExamDate($request)
    {
        $start = request('exam_date') . " " . request('exam_start');
        $start = $request->exam_date . " " . $request->exam_start;

        $start = Carbon::parse($start);
        $now = Carbon::now();

        $isDatePassed = json_encode($now->greaterThan($start));
        if ($isDatePassed == "true") {
            return false;
        }

        $examDate = Carbon::parse(request('exam_date'))->format('F j Y');

        $startTime = $start->toDateTimeString();
        $endTime = Carbon::parse($startTime)->addMinutes(request('time_limit'));

        $date = new ExamDate();
        $date->exam_id = $request->exam_id;
        $date->exam_date = $examDate;
        $date->exam_start =  $startTime;
        $date->exam_end = $endTime;
        $date->exam_type = $request->exam_type;
        $date->save();

        // $this->saveTrail("Created Exam Date " . $examDate . " for " . $date->exam_type);

        return true;
    }
}
