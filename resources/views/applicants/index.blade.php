@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-3">
<div class="card" style="height: 360px">
<div class="card-body">
    <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    @if($app->status == "denied")
        Your application has been denied
    @endif

    @if($app->status == "pending")
        Your application request is currently pending
    @else
        @if($app->status == "approved" && $app->applicantExam->exam_id == 0)
            @include('applicants.components.select_date')
        @else
            @if($app->status == "approved" &&
                $app->applicantExam->exam_result == "pending" &&
                $isExamLive==false && $isDatePassed==false)
                @include('applicants.components.your_exam')
            @endif

            @if($isExamLive==true && $app->applicantExam->exam_result=="pending")
                @include('applicants.components.take_exam')
            @endif
        @endif

        @if($isDatePassed==true)
            @if($app->applicantExam->exam_result=="passed")
              <p class="lead">You passed the entrance exam</p>
            @elseif($app->applicantExam->exam_result=="failed")
               <p class="lead">You failed the entrance exam</p>
            @else
               <p class="lead">You did not take the entrance exam</p>
            @endif
        @else
            @if($app->applicantExam->exam_result != "pending")
                @if($app->applicantExam->exam_result == "passed")
                   <p class="lead">You passed the entrance exam</p>
                @else
                <p class="lead">You failed the entrance exam</p>
                @endif
            @endif
        @endif
    @endif

</div>
</div>
</div>
@endsection
