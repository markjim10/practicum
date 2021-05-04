@extends('layouts.app')
@include('layouts.navbar')

@section('content')

<div class="container mt-5 mb-5">
    <h3> Examination Schedule</h3>
    <hr>
    <div class="row">
    <div class="col-md-6">
    <div class="card">
        <div class="card-header">Upcoming Senior High School Exam Schedules</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Exam Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($shsSched as $item)
                    @if(json_encode(Carbon\Carbon::now()->greaterThan($item->exam_end))=="false")
                        <tr>
                            <td>{{$item->exam_date}}</td>
                            <td>{{ Carbon\Carbon::parse($item->exam_start)->format('g:i A') }}</td>
                            <td>{{ Carbon\Carbon::parse($item->exam_end)->format('g:i A') }}</td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">Upcoming College Examination Schedules</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Exam Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($collegeSched as $item)
                    @if(json_encode(Carbon\Carbon::now()->greaterThan($item->exam_end))=="false")
                    <tr>
                        <td>{{$item->exam_date}}</td>
                        <td>{{ Carbon\Carbon::parse($item->exam_start)->format('g:i A') }}</td>
                        <td>{{ Carbon\Carbon::parse($item->exam_end)->format('g:i A') }}</td>
                    </tr>
                @endif
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
