@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-5">
<div class="card" style="height: 360px">
<div class="card-body">
    <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
    <hr>

    @if($app->appResult->status == "denied")
        Your application has been denied
    @endif

    @if($isDatePassed=="true")
        @if($app->appResult->exam_result=="passed")
            You passed the entrance exam
        @elseif($app->appResult->exam_result=="failed")
            You failed the entrance exam
        @else
            You did not take the entrance exam
        @endif
    @else
        @if($app->appResult->status == "approved" && $app->appResult->exam_result != "pending")
            @if($app->appResult->exam_result == "passed")
                You passed the entrance exam
            @else
                You failed the entrance exam
            @endif
        @endif
    @endif

    @if($app->appResult->status == "pending")
        Your application request is currently pending
    @else
        @if($app->appResult->status == "approved" && $app->appResult->exam_date == 0)
            @include('applicants.components.select_date')
        @else
            @if($app->appResult->status == "approved" && $app->appResult->exam_result == "pending" && $isExamLive=="false" && $isDatePassed=="false")
                @include('applicants.components.your_exam')
            @endif

            @if($isExamLive=="true" && $app->appResult->exam_result=="pending")
                @include('applicants.components.take_exam')
            @endif
        @endif
    @endif

</div>
</div>
</div>


<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>



@endsection

    {{-- <input id="secs" type="hidden" value="{{$secs}}"> --}}



    {{-- <script>

        var secs = document.querySelector('#secs').value;

        timer = setInterval(function () {
            var element = document.querySelector("#time_remaining");

            var minute = Math.floor(secs/60);
            var seconds = secs % 60;

            element.innerHTML = "<h2>You have <b>"+minute+"</b>m " +seconds+"s";
            if(secs < 1){
                clearInterval(timer);
            }
            secs--;
        }, 1000)
    </script>
     --}}
