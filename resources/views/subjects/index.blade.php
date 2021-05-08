@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<link href="{{ asset('css/subjects.css') }}" rel="stylesheet" type="text/css" >

<div class="container mt-3">

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <h2>Subject Module</h2>
    <hr>

    <div class="row">
        <div class="col-4">
            @include('subjects.create')
        </div>
        <div class="col-8">
            @include('subjects.table')
        </div>
    </div>

@endsection

