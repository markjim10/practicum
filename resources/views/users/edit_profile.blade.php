@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<div class="container-fluid mt-3">
    <h2>Edit Profile</h2>
    <hr class="site_hr">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card" style="width:100%">
                <div class="card-header">Update Photo</div>
                <div class="card-body">
                    <form action="/updateProfile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Username*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <input disabled value="{{$user->username}}" class="form-control" type="text" name="username">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Photo <span>*</span></strong></label>
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
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card" style="width: 100%">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form action="/changePassword" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><strong>Old Password</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input required class="form-control" type="password" name="old_pass">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><strong>New Password</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input required class="form-control" type="password" name="password" minlength="4">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><strong>Confirm Password</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input required class="form-control" type="password" name="confirm_password" minlength="4">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
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
