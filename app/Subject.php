<?php

namespace App;

use App\Trails;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function createSubject($request)
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

    public static function updateSubject($data)
    {
        $q = Question::where('id', $data->id)->first();
        $q->question = $data->question;
        $q->answer = $data->choice1;
        $q->save();

        $arr = array(
            $data->choice1,
            $data->choice2,
            $data->choice3,
            $data->choice4
        );

        $c = Choice::where('question_id', $data->id)->orderBy('id')->get();
        $i = 0;

        foreach ($c as $item) {
            $item->choice = $arr[$i];
            $item->save();
            $i++;
        }

        $update_subject = true;
        $questions = Question::where('subject_id', $data->subject)->get();

        foreach ($questions as $item) {
            if ($item->answer == null) {
                $update_subject = false;
                break;
            }
        }

        if ($update_subject == true) {
            $subject = Subject::where('id', $data->subject)->first();
            $subject->status = 'approved';
            Helper::saveTrails("Updated subject " . $subject->name);
            $subject->save();
        }

        return $q->id;
    }

    public static function removeSubject($id)
    {
        $subject = Subject::where('id', $id)->first();
        $subject->status = "removed";
        $subject->save();

        Helper::saveTrails("Removed subject " . $subject->name);
    }
}
