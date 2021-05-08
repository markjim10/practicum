@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-3">
<div class="card" style="height: 360px">
<div class="card-body">
    <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
    <hr>

    @if($app->status == "denied")
        Your application has been denied
    @endif

    @if($isDatePassed==true)
        @if($app->applicantExam->exam_result=="passed")
            You passed the entrance exam
        @elseif($app->applicantExam->exam_result=="failed")
            You failed the entrance exam
        @else
            You did not take the entrance exam
        @endif
    @else
        @if($app->applicantExam->exam_result != "pending")
            @if($app->appResult->exam_result == "passed")
                You passed the entrance exam
            @else
                You failed the entrance exam
            @endif
        @endif
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
    @endif

</div>
</div>
</div>
@endsection
