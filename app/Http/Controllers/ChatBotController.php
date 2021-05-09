<?php

namespace App\Http\Controllers;

use App\Word;
use App\Response;

class ChatBotController extends Controller
{
    public function message($message)
    {
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
