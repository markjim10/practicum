@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <div class="digital-clock">
                <i class='fa fa-clock-o fa-lg' aria-hidden='true'></i>
            </div>
        </div>
        <div class="col text-right">
            Hello, {{ Auth::user()->username }}
        </div>
    </div>

    <hr>
    <canvas id="datesChart" height="20vh" width="80vw"></canvas>

    <div class="row mt-5">
        <div class="col-md-6 mb-5">
        <div class="card mb-5">
            <div class="card-header">Preferred Programs</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="myChartCourses"></canvas>
                    </div>

                <div class="form-group">
                    <hr>
                    <a href="/reports_programs/"
                    class="btn btn-success btn-sm">Download Report</a>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">List of Passers</div>
            <div class="card-body">
                <div class="">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Average</th>
                            <th scope="col">Date of Exam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passers as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->average}} %</td>
                                <td>{{$item->date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <hr>
                    <a href="/reports_passers/"
                    class="btn btn-success btn-sm">Download Report</a>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6 mb-5">

        <div class="card mb-5">
                <div class="card-header">Applicants Passing Rate</div>
                <div class="card-body">
                    <canvas id="passing"></canvas>
                </div>
         </div>

         <div class="card mb-5">
            <div class="card-header">School Passing Rates</div>
            <div class="card-body">
                <div class="">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                            <th>School</th>
                            <th>Examinees</th>
                            <th>Passers</th>
                            <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schoolPassingRate as $item)
                            <tr>
                                <td>{{$item->school}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->passed}}</td>
                                <td>{{$item->average}}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <hr>
                    <a href="/reports_school_passing/"
                    class="btn btn-success btn-sm">Download Report</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script src="{{ asset('js/dashboard/preferredPrograms.js') }}"></script>
<script src="{{ asset('js/dashboard/applicantsPassing.js') }}"></script>
<script src="{{ asset('js/dashboard/examDates.js') }}"></script>
<script src="{{ asset('js/dashboard/passers.js') }}"></script>

<script src="{{ asset('js/clock.js') }}" defer></script>
@endsection

