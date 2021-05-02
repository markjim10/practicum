@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-5">
    <div class="card" style="">
        <div class="card-body">
            <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
            <hr>
            <div class="row">
                <div class="first col-md-9">
                    <h4>Applicant Profile</h4>
                    <b> Full Name: </b>{{$app->first_name}} {{$app->middle_name}} {{$app->last_name}}
                    <br>
                    <b> Email: </b>{{$app->user->email}}
                    <br>
                    <b> Province:</b> {{$app->province}}
                    <br>
                    <b> City:</b> {{$app->city}}
                    <br>
                    <b> Barangay:</b> {{$app->brgy}}
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
                    <img class="" src="data:image;base64,{{$app->card_photo}}" width="100%" height="auto;"/>

                    <br><br>

                </div>
                <div class="second col-md-3" >
                    <img src="data:image;base64,{{$app->user->photo}}" width="100%" height="auto;" style="float:right"/>
                </div>

            </div>
            <div class="row">
                <div class=" col-md-12">
                    <p style="color:red;">If you encounter any problems send us a message</p>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    $(window).resize(function() {
    if ($(window).width() < 600) {
        $(".second").addClass("order-first");
        $(".photo").css({'width' : '100%'});
    } else {
        $(".second").removeClass("order-first");
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
