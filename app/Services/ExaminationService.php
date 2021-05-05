<?php

namespace App\Services;

use App\Choice;
use App\Trails;
use App\Subject;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationService
{
    public function createSubject($request)
    {
        $name = $request->subject_name;
        $num_questions = $request->num_questions;

        $subject = new Subject();
        $subject->name = $name;
        $subject->num_questions = $num_questions;
        $subject->save();

        $subject = Subject::where('id', $subject->id)->first();

        for ($i = 0; $i < $num_questions; $i++) {
            $question = new Question();
            $question->subject_id = $subject->id;
            $question->save();

            for ($j = 0; $j < 4; $j++) {
                $choice = new Choice();
                $choice->subject_id = $subject->id;
                $choice->question_id = $question->id;
                $choice->save();
            }
        }

        Trails::saveTrails("Created subject \"" . $subject->name . "\"");
    }
}
