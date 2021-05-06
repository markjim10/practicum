@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
@include('exams.create')

<link href="{{ asset('css/exams.css') }}" rel="stylesheet" type="text/css" >

<div class="container mt-3">

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <h2>Exam Module<button class="btn btn-success btn-md float-right" data-toggle="modal" data-target="#createExamModal">Create Exam</button></h2>
    <hr>

    <div class="row">
        <div class="col-md-12">
            @include('exams.table')
        </div>
    </div>
</div>

@endsection


