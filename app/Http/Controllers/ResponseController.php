<?php

namespace App\Http\Controllers;

use App\Word;
use App\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index()
    {
        $responses = Response::all();
        return view('responses.index', compact('responses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response = new Response();
        $response->response = $request->response;
        $response->save();
        return redirect()->back()->with('message', 'Response Added');
    }

    public function show($id)
    {
        $response = Response::where('id', $id)->first();
        $words = Word::where('response_id', $response->id)->get();
        return view('responses.show', compact('response', 'words'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $response = Response::where('id', $request->id)->first();
        $response->response = $request->response;
        $response->save();
        return redirect()->back()->with('message', 'Response Updated');
    }

    public function remove($id)
    {
        Word::where('response_id', $id)->delete();
        Response::where('id', $id)->delete();
        return redirect('/responses');
    }

    public function addWord(Request $request)
    {
        $word = new Word();
        $word->response_id = $request->responseId;
        $word->word = $request->word;
        $word->save();
        return redirect()->back()->with('message', 'Word added');
    }

    public function removeWord($id)
    {
        Word::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Word removed');
    }
}
