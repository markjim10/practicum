@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<input id="secs" type="hidden" value="{{$secs}}">

<div class="container-fluid mt-5">

<h1>Entrance Examination</h1>
<hr>
<div id="time_remaining"></div>

<div class="card">
    <div class="card-body">

<div class="container-fluid">

<form id="exam" method="post" action="/exam_submit">
@csrf

@php $i = 1; $j = 0; @endphp
@foreach ($subjects as $subject)

    <h1>{{$subject->name}}</h1>

    @foreach ($questions as $question)

        @if($question->subject_id == $subject->id)
            <p><b>{{$i++}}.)</b> {{$question->question}}</p>
                <div class="col-md-6">
                @foreach ($choices as $choice)
                    @if($choice->question_id == $question->id)
                        @if($question->temp_answer==$choice->choice)
                            <div class="form-check" data-value="{{$question->id}}">
                            <input type="hidden" name="question_id[{{$j}}]" value={{$question->id}}>
                            <input type="radio"  class="xyz form-check-input" name="answer[{{$j}}]"  value="{{$choice->choice}}" checked required>{{$choice->choice}}
                            </div>
                        @else
                        <div class="form-check" data-value="{{$question->id}}">
                            <input type="hidden" name="question_id[{{$j}}]" value={{$question->id}}>
                            <input type="radio" class="xyz form-check-input" name="answer[{{$j}}]"  value="{{$choice->choice}}" required>{{$choice->choice}}
                            </div>
                        @endif
                        <br>
                    @endif
                @endforeach
                @php $j++ @endphp
            </div>
        @endif
    @endforeach
    <hr style="border: 2px solid #00214E">
@endforeach

<button class="btn btn-success btn-lg" type="submit">Submit Exam</button>

</form>

</div>
</div>
</div>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script>
$(".xyz").change(function() {

    var temp = $(this).val();

    var qID = $(this).parent().attr('data-value');
    console.log(qID);

    let data = {
            "temp" : $(this).val(),
            "qID": $(this).parent().attr('data-value'),
        }

    $.ajax({
            type:'GET',
            url:'/update_temp_answer/'+JSON.stringify(data)+'',
            data: data,
            success:function(response)
            {
                console.log(response);
            },
            error: function (request, status, error)
            {
                console.log(request.responseText);
            }
        });


})
</script>

<script>
    var secs = document.querySelector('#secs').value;
    timer = setInterval(function () {
        var element = document.querySelector("#time_remaining");
        var minute = Math.floor(secs/60);
        var seconds = secs % 60;
        element.innerHTML = "<h4>Time remaining: <b>"+minute+"</b>m " +seconds+"s</h4>";
        if(secs < 1){
            clearInterval(timer);
            location.reload()

        }
            $.ajax({
            type:'GET',
            url:'/isDatePassed',
            success:function(response)
            {
                // console.log(response);
                if(response=="true")
                {

                }
            },
            error: function (request, status, error)
            {
                console.log(request.responseText);
            }
        });

        secs--;
    }, 1000)
</script>

@endsection
