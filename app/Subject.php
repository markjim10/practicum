<?php

namespace App;

use App\Trails;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function createSubject($request)
    {
        $name = $request->subject_name;
        $num_questions = $request->num_questions;

        $subject = new Subject();
        $subject->subject_name = $name;
        $subject->num_questions = $num_questions;
        $subject->save();

        for ($i = 0; $i < $num_questions; $i++) {

            $question = new Question();
            $question->subject_id = $subject->id;
            $question->save();

            for ($j = 0; $j < 4; $j++) {
                $choice = new Choice();
                $choice->question_id = $question->id;
                $choice->save();
            }
        }
        Trails::saveTrails("Created subject \"" . $subject->name . "\"");
    }

    public function getChoicesByQuestionId($questions)
    {
        $question_id = array();
        foreach ($questions as $question) {
            array_push($question_id, $question->id);
        }

        return Choice::whereIn('question_id', $question_id)->orderBy('id', 'ASC')->get();
    }

    public function update_subject($request, $id)
    {
        $question = Question::where('id', $request->question_id)->first();
        $question->question = $request->question;
        $question->answer = $request->choice1;
        $question->save();

        $arrChoices = array(
            $request->choice1,
            $request->choice2,
            $request->choice3,
            $request->choice4
        );

        $choices = Choice::where('question_id', $request->question_id)->orderBy('id')->get();
        $i = 0;
        foreach ($choices as $choice) {
            $choice->choice = $arrChoices[$i];
            $choice->save();
            $i++;
        }

        $update_subject = true;
        $questions = Question::where('subject_id', $id)->get();

        foreach ($questions as $item) {
            if ($item->answer == null) {
                $update_subject = false;
                break;
            }
        }

        if ($update_subject == true) {
            $subject = Subject::where('id', $id)->first();
            $subject->status = 'approved';
            $subject->save();
        }

        return $question->id;
    }

    public function remove_subject($id)
    {
        $subject = Subject::where('id', $id)->first();
        $subject->status = "removed";
        $subject->save();
    }
}
