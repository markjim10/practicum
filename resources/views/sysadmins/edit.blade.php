@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<div class="container-fluid mt-3">
    <h2>Edit User</h2>
    <hr class="site_hr">

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
    @endif

    <div class="card" style="width: 50%">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="/update_user" method="POST">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Email Address</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input disabled class="form-control" type="text" value="{{$user->email}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Username</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input disabled class="form-control" type="text" value="{{$user->username}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label><strong>Role</strong></label>
                    </div>
                    <div class="col-md-8">
                        <select required class="form-control" name="role">

                            @if($user->role == "admin")
                                <option selected value="admin">Administrator</option>
                                <option value="sysadmin">System Administrator</option>
                            @else
                                <option  value="admin">Administrator</option>
                                <option selected value="sysadmin">System Administrator</option>
                            @endif

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
                    <div class="col-3">
                        <a href="/remove_user/{{$user->id}}" class="btn btn-danger ">Remove</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

