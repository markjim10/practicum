@extends('layouts.app')
@include('layouts.navbar')
@section('content')

<form action="/generate" method="post" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="container mt-5">
        <input type="file"  id="photo" name="photo">
        <br><br>
        <input type="file"  id="card_photo" name="card_photo">
        <br><br>
        <button class="btn btn-primary" type="submit">Generate</button>
    </div>
</form>
@endsection
