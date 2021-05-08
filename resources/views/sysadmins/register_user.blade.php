{{--





@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<div class="container-fluid mt-3 mb-5">
    <h2>Register User</h2>
    <hr>

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

    <div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Register</div>
        <div class="card-body">
            <form action="/register_user" method="POST">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Username*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" type="text" name="username">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Name*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" type="text" name="name">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Email Address*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" type="text" name="email">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Password*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" type="password" name="password" minlength="4">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Confirm Password*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" type="password" name="confirm_password" minlength="4">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Role*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <select required class="form-control" name="role">
                            <option value="admin">Administrator</option>
                            <option value="sysadmin">System Administrator</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
        </div>
    </div>
</div>

</div>

@endsection
 --}}
