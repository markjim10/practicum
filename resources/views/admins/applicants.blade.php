@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

{{-- <script src="{{ secure_asset('js/admins/applicants_home.js') }}" defer></script> --}}
<script src="{{ asset('js/admins/applicants_home.js') }}" defer></script>

<div class="container-fluid mt-3">
    <h2>Applicants Module</h2>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="status">Select By Status</label>
                <select class="form-control" id="status" onchange="selectedStatus()">
                  <option value="total">Total</option>
                  <option value="pending">Pending</option>
                  <option value="approved">Approved</option>
                  <option value="denied">Denied</option>
                </select>
              </div>
        </div>
        <div class="col-md-8">
            <table class="table table-striped table-bordered table-sm applicants">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Application</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="applicantsBody" style="text-transform:capitalize;">
                    @foreach($applicants as $app)
                    <tr>
                        <td>{{$app->id}}</td>
                        <td><a href="/admins/applicants/edit/{{$app->id}}">
                            {{$app->first_name}}, {{$app->last_name}}</a></td>
                        <td>{{$app->application}}</td>
                        <td>{{$app->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
