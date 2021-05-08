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
                    <a href="/programs_report/"
                    class="btn btn-success btn-sm">Download Report</a>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">Subjects Statistics</div>
            <div class="card-body">
                <div class="">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                            <th style="width: 50%">Subject</th>
                            <th style="width: 25%">Average</th>
                            <th style="width: 25%">Questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($exams_results as $item)
                            <tr>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->average}} %</td>
                                <td>{{$item->num_questions}}</td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <hr>
                    <a href="/reports_exams/"
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
                            {{-- @foreach($passers as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->average}} %</td>
                                <td>{{$item->dateExam}}</td>
                            </tr>
                            @endforeach --}}
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
    </div>
</div>

{{-- @php $i=0 @endphp
@foreach ($arrPrograms as $item)
    <input class="programs" type="hidden" value="{{$item}}">
@endforeach
@foreach ($arrProgramsCount as $item)
    <input class="programscount" type="hidden" value="{{$item}}">
@endforeach

@php $i=0 @endphp
@foreach ($arrDates as $item)
    <input class="dates" type="hidden" value="{{$item}}">
@endforeach
@foreach ($arrCounts as $item)
    <input class="counts" type="hidden" value="{{$item}}">
@endforeach --}}
{{--
<input id="passed" type="hidden" value="{{$passed}}">
<input id="failed" type="hidden" value="{{$failed}}"> --}}

{{-- <script>
    var p = document.getElementById("passed").value;
    var f = document.getElementById("failed").value;
    var ctx = document.getElementById("passing").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Passed","Failed"],
        datasets: [{
          backgroundColor: ["rgba(46,204,113,0.5)","rgba(231,76,60,0.5)",],
          borderColor: ["#2ecc71","#e74c3c",],
          data: [p, f],
          borderWidth: 3
        }]
      }
    });
</script>



<script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable({
            "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "iDisplayLength": 5,
            "order": [[1, "desc"]]
    });

    $('.dataTables_filter input[type="search"]')
    .css({ 'width': '160px', 'display': 'inline-block' });

});
</script> --}}

{{-- <script src="{{ secure_asset('js/dashboard/preferredCourses.js') }}" defer></script> --}}
{{-- <script src="{{ secure_asset('js/clock.js') }}" defer></script> --}}

<script src="{{ asset('js/dashboard/preferredPrograms.js') }}"></script>
<script src="{{ asset('js/dashboard/applicantsPassing.js') }}"></script>
<script src="{{ asset('js/dashboard/examDates.js') }}"></script>

<script src="{{ asset('js/clock.js') }}" defer></script>
@endsection

