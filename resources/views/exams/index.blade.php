@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<link href="{{ asset('css/subjects.css') }}" rel="stylesheet" type="text/css" >

<div class="container mt-3">

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <h2>Exam Module</h2>
    <hr>

    <div class="row">
        <div class="col-md-4">
            @include('exams.create')
        </div>
        <div class="col-md-8">
            @include('exams.table')
        </div>
    </div>

</div>

<script>
$('.table').DataTable({

});
</script>

@endsection


