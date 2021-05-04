@extends('layouts.app')
@extends('sidebars.sidebar')
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
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Program</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($schoolPassingRate as $item)
                    <tr>
                        <td>{{$item->school}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->passed}}</td>
                        <td>{{$item->average}}%</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

{{--
    <div class="row">
        <div class="col-md-4">
          <div class="list-group" id="list-tab" role="tablist" style="border-radius: 0%">
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-total-list" data-toggle="list" href="#list-total" role="tab" aria-controls="home">
            Home</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-pending-list" data-toggle="list" href="#list-pending" role="tab" aria-controls="profile">Pending</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-approved-list" data-toggle="list" href="#list-approved" role="tab" aria-controls="approved">Approved</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-denied-list" data-toggle="list" href="#list-denied" role="tab" aria-controls="denied">Denied</a>
          </div>

        </div>
        <div class="col-md-8">
          <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="list-total" role="tabpanel" aria-labelledby="list-total-list">
                @include('admins.applicants.components.total') <br>
            </div>

            <div class="tab-pane fade" id="list-pending" role="tabpanel" aria-labelledby="list-pending-list">
                @include('admins.applicants.components.pending') <br>
            </div>

            <div class="tab-pane fade" id="list-approved" role="tabpanel" aria-labelledby="list-approved-list">
                @include('admins.applicants.components.approved') <br>
            </div>

            <div class="tab-pane fade" id="list-denied" role="tabpanel" aria-labelledby="list-denied-list">
                @include('admins.applicants.components.denied') <br>
            </div>

          </div>
        </div>
      </div> --}}




@endsection
