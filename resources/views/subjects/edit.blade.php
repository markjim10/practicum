@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-3">

    <input type="hidden" id="subject_id" value="{{$subject->id}}">

    <div class="row">
        <div class="col"><h1>{{$subject->subject_name}}</h1></div>
        <div class="col text-right">
            <a href="/subjects/remove/{{$subject->id}}" class="btn btn-danger btn-md">Remove</a>
        </div>
   </div>

    <hr>

    @php $count=1 @endphp
    @foreach ($questions as $question)
    <div class="card mb-3">
        <div class="card-body">

            <div class="form-group">
                <label class="question">Question {{$count++}}</label>
                <input type="text" class="form-control form-control-sm" placeholder="Enter question"
                value="{{$question->question}}"
                id="question{{$question->id}}">
            </div>

            <div class="row">
            @php $i=0 @endphp
            @foreach($choices as $choice)
                @if($choice->question_id == $question->id)
                    <div class="col-md-3">
                        <div class="form-group">
                            @if($i == 0)
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

    var subject_id = document.querySelector("#subject_id").value;
    var question = document.querySelector("#question"+this.id).value;
    var choice1 = document.querySelector("#question"+this.id+"choice0").value;
    var choice2 = document.querySelector("#question"+this.id+"choice1").value;
    var choice3 = document.querySelector("#question"+this.id+"choice2").value;
    var choice4 = document.querySelector("#question"+this.id+"choice3").value;

    if(choice1=="" || choice2=="" || choice3=="" || choice4=="")
    {
        alert('Fill all the choices');
    }
    else
    {
        let data = {
            "subject_id" : subject_id,
            "question_id": this.id,
            "question":question,
            "choice1": choice1,
            "choice2": choice2,
            "choice3": choice3,
            "choice4": choice4
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'PUT',
            url:`/subjects/${subject_id}`,
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

@endsection

