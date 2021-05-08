@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')
<div class="container-fluid mt-3">
    <h2>Export Database Tables</h2>
    <hr>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-12">
                    <b>Users Table</b>
                    <a href="/exportUsers" style="float: right;"
                    class="btn btn-success btn-sm">Export</a>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-12">
                    <b>Applicants Table</b>
                    <a href="/exportApplicants" style="float: right;"
                    class="btn btn-success btn-sm">Export</a>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-12">
                    <b>Applicants Results</b>
                    <a href="/exportAppResults" style="float: right;"
                     class="btn btn-success btn-sm">Export</a>
                </div>
            </div>
        </li>
    </ul>
</div>

@endsection

