<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function response()
    {
        return $this->belongsTo(Response::class);
    }

    public static function addWord($id, $word)
    {
        $addWord = new Word();
        $addWord->response_id = $id;
        $addWord->word = strtolower($word);
        $addWord->save();

        return $addWord;
    }

    public static function removeWord($id)
    {
        $word = Word::where('id', $id)->first();
        $response = Response::where('id', $word->response_id)->first();
        Trails::saveTrails("Removed a word response \"" . $word->word . "\" for \"" . $response->response . "\"");
        $word->delete();

        return $id;
    }
}
