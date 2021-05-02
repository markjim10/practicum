@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<link href="{{ asset('css/exam_create.css') }}"  rel="stylesheet" defer>

<div class="container-fluid mt-2">
<h1>{{$subject->name}}</h1>
<input type="hidden" id="subject_id" value="{{$subject->id}}">
<hr>
@php $count=1 @endphp
@foreach ($questions as $question)
<div class="card mb-3">
<div class="card-body">
<div class="form-group">
    <label class="question">Question {{$count++}}</label>
    <input type="text" class="form-control form-control-sm" placeholder="Enter question"
    value="{{$question->question}}"
    id="question{{$question->id}}"
    >
</div>

<div class="row">
@php $i=0 @endphp
@foreach($choices as $choice)
    @if($choice->question_id == $question->id)
        <div class="col-md-3">
            <div class="form-group">

                @if($i==0)
                    <label class="answer">Answer</label>
                    <input type="text" class="form-control form-control-sm"
                    placeholder="Enter answer"
                    value="{{$choice->choice}}"
                    id="question{{$question->id}}choice{{$i++}}">
                @else
                    <label>Choices</label>
                    <input type="text" class="form-control form-control-sm"
                    placeholder="Enter choice"
                    value="{{$choice->choice}}"
                    id="question{{$question->id}}choice{{$i++}}">
                @endif

            </div>
        </div>
    @endif
@endforeach
</div>

<button id="{{$question->id}}" class="submit btn btn-primary btn-sm">
    Save
</button>

</div>
</div>
@endforeach
</div>

<script>

$(".submit").click(function() {
    var subject = document.querySelector("#subject_id").value;
    var question = document.querySelector("#question"+this.id).value;
    question = encodeURIComponent(question);

    var choice1 = document.querySelector("#question"+this.id+"choice0").value;
    var choice2 = document.querySelector("#question"+this.id+"choice1").value;
    var choice3 = document.querySelector("#question"+this.id+"choice2").value;
    var choice4 = document.querySelector("#question"+this.id+"choice3").value;

    var $x = (this);

    if(question=="" || choice1=="" || choice2=="" || choice3=="" || choice4=="")
    {
        alert('fill all fields');
    }
    else
    {
        let data = {
            "id" : this.id,
            "subject": subject,
            "question": question,
            "choice1": choice1,
            "choice2": choice2,
            "choice3": choice3,
            "choice4": choice4
        }

            $.ajax({
            type:'GET',
            url:'/update_subject/'+JSON.stringify(data)+'',
            data: data,
            success:function(response)
            {
                $(`#${response}`).attr("class", "xyz btn btn-success btn-sm");
                $(`#${response}`).hide().fadeIn(500);
                console.log(response);
            },
            error: function (request, status, error)
            {
                console.log(request.responseText);
            }
        });
    }
});

</script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
@endsection

