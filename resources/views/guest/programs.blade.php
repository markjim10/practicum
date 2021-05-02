@extends('layouts.app')
@include('layouts.navbar')

@section('content')

<div class="container mt-5 mb-5">
    <h3>Programs Offered</h3>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/cas.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>College of Arts and Science</h4>
                    <ul>
                        @foreach ($cas as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/ccis.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>College of Computer and Information Science</h4>
                    <ul>
                        @foreach ($ccis as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/ety.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>E.T.Yuchengco College of Business</h4>
                    <ul>
                        @foreach ($ety as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/cmet.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>Mapua - PTC College of Maritime Education and Training</h4>
                    <ul>
                        @foreach ($mare as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/mitl.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>Mapua Institute of Technology at Laguna</h4>
                    <ul>
                        @foreach ($mitl as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/shs.png') }}" width="100%" alt="">
                </div>
                <div class="col-10">
                    <h4>Senior High School</h4>
                    <ul>
                        @foreach ($shs as $item)
                            <li>{{$item->program_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
