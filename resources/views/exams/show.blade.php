@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<div class="container-fluid mt-5 mb-5">
<h1>{{$exam->exam_name}}</h1>
<div class="card">
    <div class="card-body">
        <div class="container-fluid">
        @php $i = 1; $j = 0; @endphp
        @foreach ($subjects as $subject)
            <h2>{{$subject->subject_name}}</h2>
            <hr>
            @foreach ($questions as $question)
                @if($question->subject_id == $subject->id)
                    <p><b>{{$i++}}.)</b> {{$question->question}}</p>
                        <div class="col-md-6">
                        @foreach ($choices as $choice)
                            @if($choice->question_id == $question->id)
                                <div class="form-check" data-value="{{$question->id}}">
                                    <input type="hidden" name="question_id[{{$j}}]"
                                    value={{$question->id}}>
                                    <input disabled type="radio" class="xyz form-check-input"
                                    name="answer[{{$j}}]"  value="{{$choice->choice}}" required>
                                    @if($choice->choice==$question->answer)
                                    <b style="color:red">{{$choice->choice}} (ANSWER)</b>
                                    @else
                                    {{$choice->choice}}
                                    @endif
                                </div>
                            <br>
                            @endif
                        @endforeach
                        @php $j++ @endphp
                    </div>
                @endif
            @endforeach
        @endforeach
        </div>
    </div>
</div>

@endsection
