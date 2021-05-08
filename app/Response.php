<?php

namespace App;

use App\Word;
use App\Trails;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function getWordCount()
    {
        return $this->words->count();
    }

    public function createResponse($request)
    {
        $res = new Response();
        $res->response = $request->response;
        $res->save();
        Trails::saveTrails("Created a chatbot response \"" . $res->response . "\"");

        return $res;
    }

    public static function updateResponse($response)
    {
        $res = Response::where('id', $response->id)->first();
        $res->response = $response->response;
        $res->save();

        Trails::saveTrails("Created a chatbot response \"" . $res->response . "\"");
        return $res;
    }

    public static function removeResponse($id)
    {
        $res = Response::where('id', $id)->first();
        $words = Word::where('response_id', $id)->get();

        foreach ($words as $word) {
            $word->delete();
        }

        Trails::saveTrails("Removed a chatbot response \"" . $res->response . "\"");
        $res->delete();
    }
}
