@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <div class="digital-clock">
                <i class='fa fa-clock-o fa-lg' aria-hidden='true'></i>
            </div>
        </div>
        <div class="col text-right">
            Hello, {{$admin->name}}
        </div>
    </div>
    <hr class="site_hr">
    <div class="card">
        <div class="card-header">Users List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="users table table-dark table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">ID</th>
                            <th scope="col" style="width: 25%">Name</th>
                            <th scope="col" style="width: 20%">Username</th>
                            <th scope="col" style="width: 25%">Email</th>
                            <th scope="col" style="width: 10%">Role</th>
                            <th scope="col" style="width: 10%">Edit</th>
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
                                    <a href="/edit_user/{{$item->id}}">
                                    <button class="btn btn-info btn-sm" type="submit">Edit</button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ secure_asset('js/clock.js') }}" defer></script>
<script src="{{ asset('js/clock.js') }}" defer></script>

<script>
    $('table').DataTable({
        "autoWidth": false,
    });
</script>

@endsection

