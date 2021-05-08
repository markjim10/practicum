<?php

namespace App\Http\Controllers;

use App\Word;
use App\Trails;
use App\Response;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{

    public function index()
    {
        $responses = Response::all();
        return view('chatbots.index', compact('responses'));
    }

    public function store(Request $request)
    {
        $response = new Response();
        $response->response = $request->response;
        $response->save();
        return redirect()->back()->with('message', 'Response Added');
    }




















    // public function create($id)
    // {
    //     $response = Response::where('id', $id)->first();
    //     $words = Word::where('response_id', $response->id)->get();
    //     return view('admins.chatbots.chatbot_response', compact('response', 'words'));
    // }

    // public function create_response(Request $request)
    // {
    //     return Response::createResponse($request);
    // }

    // public function update_response(Request $request)
    // {
    //     return Response::updateResponse($request);
    // }

    // public function remove_response(Request $request)
    // {
    //     $id = $request->id;
    //     Response::removeResponse($id);
    //     return $id;
    // }

    // public function create_word(Request $request)
    // {
    //     $word =  $request->word;
    //     $id =  $request->responseId;
    //     $response = Response::where('id', $id)->first();
    //     Trails::saveTrails("Created a word response \"" . $word . "\" for \"" . $response->response . "\"");
    //     return Word::addWord($id, $word);
    // }

    // public function remove_word(Request $request)
    // {
    //     $id =  $request->id;
    //     return  Word::removeWord($id);
    // }

    // public function message($message)
    // {
    //     $arrMsg = explode(" ", strtolower($message));
    //     $count = sizeof($arrMsg);
    //     $words = Word::all();
    //     if ($count < 3) {
    //         return "Too short";
    //     } else {
    //         $res = array();
    //         foreach ($words as $word) {
    //             for ($i = 0; $i < $count; $i++) {
    //                 if ($arrMsg[$i] == $word->word) {
    //                     array_push($res, $word->response_id);
    //                 }
    //             }
    //         }

    //         if (!empty($res)) {
    //             $correct = 0;
    //             $c = array_count_values($res);
    //             $val = array_search(max($c), $c);
    //             $response = Response::where('id', $val)->first();

    //             $words = Word::where('response_id', $response->id)->get();

    //             foreach ($words as $word) {
    //                 for ($i = 0; $i < $count; $i++) {
    //                     if ($arrMsg[$i] == $word->word) {
    //                         $correct++;
    //                     }
    //                 }
    //             }

    //             if ($correct < 3) {
    //                 $answer = 'please specify . . .';
    //             } else {
    //                 $answer = $response->response;
    //             }
    //         } else {
    //             $answer = 'not found . . .';
    //         }
    //         return $answer;
    //     }
    // }
}
