@extends('layouts.app')
@include('layouts.navbar')
@section('content')

<script src="{{ secure_asset('js/register_applicant.js') }}" defer></script>
<script src="{{ asset('js/register_applicant.js') }}" defer></script>

<div class="container mt-5 mb-5">

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <h4 class="site_font">Online College and Senior High School Application</h4>

    <p><span><b>*</b></span> - indicates required</p>

    <br>

    <div class="row">
        <div class="col-md-6">
            <h5 class="site_font">Basic Information</h5>
            <hr>
            <form action="/register-applicant" id="form_submit" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>First Name <span>*</span> </strong></label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="first_name" value="{{old('first_name')}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Middle Name <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="middle_name" value="{{old('middle_name')}}" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Last Name <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="last_name" value="{{old('last_name')}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Province <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <select name="province" id="province">
                                <option value="" selected disabled>Select Province</option>
                                @foreach ($provinces as $item)
                                <option value="{{$item->province_code}}">
                                {{$item->province_description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>City <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <select name="city" id="city">
                            <option value="" selected disabled>Select City</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Barangay <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" spellcheck="false" class="form-control" name="brgy"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Phone Number <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm custom-form"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            onKeyPress="if(this.value.length==11) return false;"
                            >
                            <small id="phone_message"></small>
                            <div style="color:red;">{{ $errors->first('phone') }}</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Date of Birth <span>*</span></strong></label>
                        </div>

                        <div class="col-md-3">
                            <select name="birth_month" id="birth_month">
                                <option value="" selected disabled>Month</option>
                                @for($i = 0; $i<12; $i++)
                                <option value="{{$months[$i]}}" >{{$months[$i]}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="birth_day" id="birth_day">
                                <option value="" selected disabled>Day</option>
                                @for($i = 1; $i<32; $i++)
                                <option value="{{$i}}" >{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select id="birth_year" name="birth_year">
                                <option value="" selected disabled>Year</option>
                                @for($i = 2002; $i>=1970; $i--)
                                <option value="{{$i}}" >{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                        <small id="birthday_message"></small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label><strong>Email Address <span>*</span></strong></label>
                        </div>
                        <div class="col-md-8">
                            <input
                            type="text" name="email_address" id="email_address"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            <small class="" id="email_message">After entering email, wait for email validation</small>
                        </div>
                    </div>
                </div>


        </div>

        <div class="col-md-6">
            <h5 class="site_font">Academic Information</h5>
            <hr>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>School Attended <span>*</span></strong></label>
                    </div>
                    <div class="col-md-8">
<textarea class="form-control" spellcheck="false" name="school_last_attended" required rows="3">{{old('school_last_attended')}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Applicant Photo <span>*</span></strong></label>
                        <small id="photo_message"></small>
                    </div>
                    <div class="col-md-8">
                        <div class="custom-file">
                            <label id="photo_label" class="custom-file-label">Select Photo</label>
                            <input type="file" class="form-control-file  custom-file-input"
                            id="photo" name="photo" required>
                        </div>
                        <small class="text-muted">Maximum image size must be less than 4MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Report Card Photo <span>*</span></strong></label>
                        <small id="card_message"></small>
                    </div>
                    <div class="col-md-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="card_photo"
                            id="card_photo" name="card_photo">
                            <label id="card_label" class="custom-file-label" for="card_photo">Select Card Photo</label>
                        </div>
                        <small class="text-muted">Maximum image size must be less than 4MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Select Application <span>*</span></strong></label>
                    </div>
                    <div class="col-md-8">
                        <select name="application" id="application">
                            <option value="" selected disabled>Select Type of Application</option>
                            <option value="college">College</option>
                            <option value="shs">Senior High School</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Preferred Program <span>*</span></strong></label>
                    </div>
                    <div class="col-md-8">
                        <select name="preferred_program" id="preferred_program">
                            <option value="" selected disabled>Select Program</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- <br>
            <h5 class="site_font">Account Details </h5>
            <hr>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Password <span>*</span></strong></label>
                    </div>
                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control form-control-sm custom-form" name="password">
                        <small id="password_message"></small>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Confirm Password <span>*</span></strong></label>
                    </div>
                    <div class="col-md-8">
                        <input id="confirm" type="password" class="form-control form-control-sm custom-form" name="password_confirmation">
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
            <div class="form-check">
                <input id="agree" type="checkbox" class="form-check-input" name="checkbox">
                <label for="agree"><small class="text-muted">I agree to be part of the website analytics.</small><span><b>*</b></span></label>
            </div>
            <div style="color:red;">{{ $errors->first('checkbox') }}</div>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-2">
                        <button id="submit" type="submit" class="btn btn-primary btn-success" id="no-radius" style="width:160px; height: 40px;">
                            <i class="fa fa-pencil-square-o"></i><span class="ml-1"></span>
                            Register</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </div>
</div>

@endsection



