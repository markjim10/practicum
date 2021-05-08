@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<input id="responseId" type="hidden" value="{{$response->id}}">

<style>
    .remove {
        float: right;
        color: red
    }
    .remove:hover {
        opacity: 0.8;
    }
</style>

<div class="container-fluid mt-3 mb-5">
    <h2>Chat Bot Module - Words
        <a href="/responses/remove/{{$response->id}}"
            class="btn btn-danger btn-md float-right">Remove</a>
    </h2>
    <hr>
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <form action="/responses/{{$response->id}}" method="POST">
                <input type="hidden" name="id" value="{{$response->id}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Response</label>
                    <textarea name="response" textarea spellcheck="false" class="form-control" id="response" rows="3" required>{{$response->response}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" >Update</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add word</div>
            <div class="card-body">
            <form action="/responses/addWord" method="POST">
                <input type="hidden" name="responseId" value="{{$response->id}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="word">Word</label>
                </div>
                <div class="col-md-6">
                    <input name="word" type="text" class="form-control form-control-sm">
                </div>
                <div class="col-md-4">
                    <button style="margin-top:0%" class="btn btn-primary form-control btn-sm">Add</button>
                </div>
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <h3>List of words for this Response</h3>
            <ul class="list-group">
                @foreach($words as $word)
                    <li class="list-group-item">{{$word->word}}
                        <a href="/responses/removeWord/{{$word->id}}"
                            onclick="return confirm('Are you sure?')">
                        <i class="fas fa-times remove"></i></li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>


    {{-- <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Create a Bot Response</div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label>Response</label>
                            <textarea textarea spellcheck="false" class="form-control" id="response" rows="3" required>{{$response->response}}</textarea>
                            <small id="err"></small>
                        </div>
                        <div class="form-group">
                            <button id="btnResponse" class="btn btn-primary" >Update</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add a word to the Response</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><strong>Word</strong></label>
                            </div>
                            <div class="col-md-6">
                                <input id="word" type="text" class=" form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <button style="margin-top:0%" class="btnWord btn btn-primary form-control btn-sm">Add</button>
                            </div>
                        </div>
                        <div id="msgWordSuccess"></div>
                        <small id="msgWordErr"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">List of saved Words</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width:80%">Saved Words</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $item)
                            <tr>
                                <th>
                                <div class="row">
                                    <div class="col-8">
                                        {{$item->word}}
                                    </div>
                                    <div class="col-4">
                                        <a
                                        id="{{$item->id}}"
                                        class="btnRemove btn btn-danger btn-sm">Remove</a>
                                    </div>
                                </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>

@endsection
