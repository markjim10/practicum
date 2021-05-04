@extends('layouts.app')
@include('layouts.navbar')
@section('content')

<style>
    label {
        font-weight: bold;
    }
    span {
        font-weight: bold;
        color: red;
    }
</style>

<script src="{{ secure_asset('js/register_applicant.js') }}" defer></script>
<script src="{{ asset('js/register_applicant.js') }}" defer></script>

<div class="container mt-5 mb-5">

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <h3 class="site_font">Online College and Senior High School Application</h3>

    <p style="margin-bottom: 24px;"><span>*</span> - indicates required</p>

    <div class="row">
        <div class="col-md-6">
            <h5 class="site_font">Basic Information</h5>
            <hr>
            <form action="/register_applicant" id="form_submit" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="first_name">First Name <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="middle_name">Middle Name <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" name="middle_name" id="middle_name" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="last_name">Last Name <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="province">Province <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="province" id="province" class="form-control form-control-sm" required>
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
                            <label for="city">City <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="city" id="city" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Select City</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brgy">Barangay <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" class="form-control" spellcheck="false" class="form-control" name="brgy" id="brgy" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="phone">Phone Number <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm"
                            id="phone"
                            name="phone"
                            onKeyPress="if(this.value.length==11) return false;"
                            required
                            >
                            <small id="phone_message"></small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date of Birth <span>*</span></label>
                        </div>

                        <div class="col-md-3">
                            <select name="birth_month" id="birth_month" class="form-control form-control-sm" required>
                                <option value="" selected disabled>Month</option>
                                @for($i = 0; $i<12; $i++)
                                <option value="{{$months[$i]}}" >{{$months[$i]}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="birth_day" id="birth_day" class="form-control form-control-sm" required>
                                <option value="" selected disabled>Day</option>
                                @for($i = 1; $i<32; $i++)
                                <option value="{{$i}}" >{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select id="birth_year" name="birth_year" class="form-control form-control-sm" required>
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
                            <label for="email_address">Email Address <span>*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input
                            type="text" class="form-control form-control-sm" name="email_address" id="email_address"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            required>
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
                        <label for="school_last_attended">School Attended <span>*</span></label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" spellcheck="false" id="school_last_attended"
                        name="school_last_attended" required rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="photo">Applicant Photo <span>*</span></label>
                        <small id="photo_message"></small>
                    </div>
                    <div class="col-md-8">
                        <div class="custom-file">
                            <label id="photo_label" class="custom-file-label">Select Photo</label>
                            <input type="file" class="form-control-file custom-file-input"
                            id="photo" name="photo" required>
                        </div>
                        <small class="text-muted">Maximum image size must be less than 4MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="card_photo">Report Card Photo <span>*</span></label>
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
                        <label for="application">Select Application <span>*</span></label>
                    </div>
                    <div class="col-md-8">
                        <select name="application" id="application" class="form-control form-control-sm" required>
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
                        <label for="preferred_program">Preferred Program <span>*</span></label>
                    </div>
                    <div class="col-md-8">
                        <select name="preferred_program" id="preferred_program" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Select Program</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input id="agree" type="checkbox" class="form-check-input" name="checkbox" required>
                    <label for="agree"><small class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit beatae similique exercitationem dignissimos quia iusto debitis qui est quos ipsam odit molestias necessitatibus unde cumque error fugit, asperiores possimus neque?</small></label>
                </div>
                <div style="color:red;">{{ $errors->first('checkbox') }}</div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <button id="submit" type="submit" class="btn btn-primary btn-success" id="no-radius" style="min-width: 160px">
                        <i class="fa fa-sign-in-alt" style="margin-right: 4px"></i>
                        Register</button>
                </div>
            </div>
        </div>
        </form>
        </div>
    </div>
</div>

@endsection



