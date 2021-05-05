@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

{{-- <script src="{{ asset('js/admins/exams.js') }}" defer></script>
<link href="{{ asset('css/exam_admin.css') }}"  rel="stylesheet" defer> --}}

<style>

</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="container-fluid mt-3 mb-3">
    <h2>Examinations Module</h2>
    <hr>
    @if (Session::has('errors'))
        <div class="alert alert-danger">{{ Session::get('errors') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <h3>Create Exams</h3>
    <div class="row">
        <div class="col-md-6">
            @include('admins.exams.component_exam') <br>
        </div>
        <div class="col-md-6">
            @include('admins.exams.component_exam_table') <br>
        </div>
    </div>

    <hr>

    <h3>Create Subjects</h3>
    <div class="row">
        <div class="col-md-6">
            @include('admins.exams.component_createSubject') <br>
        </div>
        <div class="col-md-6">
            @include('admins.exams.component_subject_table') <br>
        </div>
    </div>
    <hr>

    <h3>Create Examination Dates</h3>
    <div class="row">
        <div class="col-md-6">
            @include('admins.exams.component_date_create')
        </div>
        <div class="col-md-6">
            @include('admins.exams.component_date_table') <br>
        </div>
    </div>
<script>
    $( function() {
        $( "#exam_date" ).datepicker({
            minDate: 0,
        });
    });
</script>

@endsection
