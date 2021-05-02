@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-3">
    <h2>Feedbacks Module</h2>
    <hr class="site_hr">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
<div class="row">
    <div class="col-md-12">
        @foreach ($feedbacks as $item)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <b>{{$item->message}}</b> <br>
                        <small class="text-muted">Date: {{$item->created_at}}</small>
                        <hr>
                        <img class="rounded-circle" src="data:image;base64,{{$item->applicant->user->photo}}" width="50"/> {{$item->applicant->first_name}}
                        {{$item->applicant->last_name}}<br>


                    </div>
                    <div class="col-4">
                        <a href="/remove_feedback/{{$item->id}}">
                            <button style="float: right; border-radius:50%;" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-times-circle"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @endforeach
    </div>
</div>

</div>

@endsection

