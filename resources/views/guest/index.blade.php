@extends('layouts.app')
@include('layouts.navbar')
@section('content')
<div class="container mt-5">
    <h1 class="site_font">Entrance Examination and Registration System</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/test1.png') }}" width="75%" />
            <hr id="home_hr">
        </div>
        <div class="col-md-6">
        <p class="lead">A mobile and web-based College and Senior High School online admission and examination system which allows applicants to register and participate to the online entrance examination.</p>

        <div class="form-group">
            <a href="/register-applicant" class="btn btn-success home">
                <i class="fa fa-pencil-square-o"></i><span class="ml-1"></span>
                Register</a>
        </div>

        <div class="form-group">
            <a href="/login" class="btn btn-primary home ">
            <i class="fa fa-sign-in-alt "></i><span class="ml-1"></span>
            Sign-in</a>
        </div>

        </div>
    </div>
</div>

<div class="icon-bar">
    <a class="chat" style="padding:0;">
        <img class="rounded-circle" src="{{ asset('images/msgr-icon.png') }}" width="56">
    </a>
</div>

<div class="chat-frame">
    <iframe src="{{URL::to('/chatbot')}}" scrolling="no"></iframe>
</div>

<script>

$(".chat-frame").hide();
$(".chat").click(function() {
    $(".chat-frame").toggle(300);
});

</script>

@endsection


