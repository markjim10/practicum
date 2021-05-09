@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-5">
    <div class="card" style="height:360px;">
        <div class="card-body">
            <h3>Hello, {{$applicant->first_name}} {{$applicant->last_name}}</h3>
            <hr>
            <h4 style="color:#00214E">Exam Results</h4>
            <div class="row">
                <div class="col-6">
                <b>Overall Score:</b> {{$applicant->exam_score * 100}} %
                <br>
                <b>Result:</b>
                @if($applicant->exam_result=="failed")
                <span
                style="text-transform: uppercase; color:red; font-weight:bold">
                {{$applicant->exam_result}}
                </span>
                @else
                <span
                style="text-transform: uppercase; color:green; font-weight:bold">
                {{$applicant->exam_result}}
                </span>

                <br>
                <b>Date of Exam:</b> {{$applicant->exam_date}}
                <br>
                <b>Time started:</b> {{$applicant->exam_start}}
                <br>
                <b>Time finished:</b> {{$applicant->exam_end}}
                <br>
                <b>Total time:</b>
                </div>

                <div class="col-6">
                    @foreach ($subjects as $subject)
                    <b>{{$subject->subject_name}}:</b> {{$subject->score * 100}} %
                    <br>
                @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
