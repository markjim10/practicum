@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<link href="{{ asset('css/chat_admin.css') }}" rel="stylesheet" type="text/css" >

<div class="container-fluid mt-3 mb-5">
    <h2>Chat Bot Module - Responses</h2>

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <hr>
    <div class="row">
        <div class="col-md-4">
            @include('responses.create')
        </div>
        <div class="col-md-8">
           @include('responses.table')
        </div>
    </div>
@endsection
