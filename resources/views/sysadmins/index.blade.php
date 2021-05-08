@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
@include('sysadmins.create')
@include('sysadmins.edit')

<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col">
            <div class="digital-clock">
                <i class='fa fa-clock-o fa-lg' aria-hidden='true'></i>
            </div>
        </div>
        <div class="col text-right">
            Hello, {{$admin->name}}
        </div>
    </div>
    <hr>

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif

    <h3>List of Administrators
    <button type="button" style="float: right" class="btn btn-success btn-md"
    data-toggle="modal" data-target="#createModal">
        Register Admin
    </button>
</h3>
    <div class="table-responsive mt-5">
        <table class="users table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->userAdmin->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->role}}</td>
                    @if($item->id == Auth::user()->id)
                        <td></td>
                    @else
                        <td>
                            <button value="{{$item->id}}"
                                onclick="getUser(this)"
                                type="button" class="btn btn-primary btn-sm"
                                data-toggle="modal" data-target="#editModal">
                                Edit
                            </button>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script src="{{ secure_asset('js/clock.js') }}" defer></script>
<script src="{{ asset('js/clock.js') }}" defer></script>

<script>
    $('table').DataTable({
        "autoWidth": false,
    });
</script>

@endsection

