@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<div class="container-fluid mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <h3>{{$app->first_name}} {{$app->last_name}} -
            @if($app->status=="approved")
                <span style="text-transform:uppercase; color:green;"><b>{{$app->status}}</b></span>
            @elseif($app->status=="pending")
                <span style="text-transform:uppercase; color:orange;"><b>{{$app->status}}</b></span>
            @else
                <span style="text-transform:uppercase; color:red;"><b>{{$app->status}}</b></span>
            @endif
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <b> Full Name: </b>{{$app->first_name}} {{$app->middle_name}} {{$app->last_name}}
                    <br>
                    <b> Email: </b>{{$app->user->email}}
                    <br>
                    <b> Province:</b> {{$app->province}}
                    <br>
                    <b> City:</b> {{$app->city}}
                    <br>
                    <b> Phone:</b> {{$app->phone}}
                    <br>
                    <b> Date of Birth:</b> {{$app->date_of_birth}}
                    <br>
                    <b> Preferred Program:</b> {{$app->program->program_name}}
                    <br>
                    <b> School Last Attendend:</b> {{$app->school_last_attended}}
                    <br>
                    <hr>
                    <img src="data:image;base64,{{$app->card_photo}}" width="100%" height="auto;"/>
                    <hr>

                    @if($app->status=="pending")
                        <div class="form-group">
                            <a href="/applicants/approved/{{$app->id}}" class="btn btn-success"
                                style="width: 140px">
                                Approve</a>
                        </div>
                        <div class="form-group">
                        <a href="/applicants/denied/{{$app->id}}" class="btn btn-danger"
                            style="width: 140px">
                            Deny</a>
                        </div>
                    @endif
                </div>

                <div class="col-md-3" >
                    <img class="photo" src="data:image;base64,{{$app->user->photo}}"
                    width="100px" height="auto;" style="float:right"/>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
