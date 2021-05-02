@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-5">
    <div class="card" style="height:360px;">
        <div class="card-body">
            <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
            <hr>
            @if($appResult->exam_result=="pending")
                You have not taken the exam
            @else
            <h4 style="color:#00214E">Exam Results</h4>
            <div class="row">
                <div class="col-6">
                <b>Overall Score:</b> {{$appResult->exam_score * 100}} %
                <br>
                <b>Result:</b>
                @if($appResult->exam_result=="failed")
                <span
                style="text-transform: uppercase; color:red; font-weight:bold">
                {{$appResult->exam_result}}
                </span>
                @else
                <span
                style="text-transform: uppercase; color:green; font-weight:bold">
                {{$appResult->exam_result}}
                </span>
                @endif
                <br>
                <b>Date of Exam:</b> {{$dateExam}}
                <br>
                <b>Time started:</b> {{$start}}
                <br>
                <b>Time finished:</b> {{$end}}
                <br>
                <b>Total time:</b> {{$totalDuration}}
                </div>

                <div class="col-6">
                    @foreach ($results as $item)
                    <b>{{$item->name}}:</b> {{$item->score * 100}} %
                    <br>
                @endforeach
                </div>
            </div>
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
