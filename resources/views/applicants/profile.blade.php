@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-5">
    <div class="card" style="">
        <div class="card-body">
            <h3>{{$app->first_name}} {{$app->last_name}}</h3>
            <hr>
            <div class="row">
                <div class="first col-md-9">
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
                    <img class="" src="data:image;base64,{{$app->card_photo}}"
                    width="100%" height="auto;"/>
                    <br><br>

                </div>
                <div class="second col-md-3" >
                    <img src="data:image;base64,{{$app->user->photo}}" width="100%" height="auto;" style="float:right"/>
                </div>

            </div>
            <div class="row">
                <div class=" col-md-12">
                    <p style="color:red;">If you encounter any problems send us an email</p>
                </div>
            </div>


        </div>
    </div>
</div>




@endsection
