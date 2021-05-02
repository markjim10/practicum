@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-5">
    <div class="card" style="height:420px;">
        <div class="card-body">
        <h3>Hello, {{$app->first_name}} {{$app->last_name}}</h3>
        <hr>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h4 style="color:#00214E">Send Feedbacks</h4>

        <form action="/send-feedback" method="post" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <textarea class="form-control" name="message" rows="4" required>{{old('message')}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
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
