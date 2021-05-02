@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')


<div class="container-fluid mt-3">
    <h2>Export Database Tables</h2>
    <hr class="site_hr">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-2">
                    <b>Users Table</b>
                </div>
                <div class="col-md-2">
                    <a href="/exportUsers" class="btn btn-success btn-sm">Export</a>
                </div>
                <div class="col-md-4">
                {{-- <form action="/import_users" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" required>
                        <label class="custom-file-label" for="customFile">Select Excel File to Import</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="submit btn btn-primary btn-sm">Import</button>
                </div>
                </form> --}}
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-2">
                    <b>Applicants Table</b>
                </div>
                <div class="col-md-2">
                    <a href="/exportApplicants" class="btn btn-success btn-sm">Export</a>
                </div>
                <div class="col-md-4">
                {{-- <form action="import_applicants" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" required>
                        <label class="custom-file-label" for="customFile">Select Excel File to Import</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="submit btn btn-primary btn-sm">Import</button>
                </div>
                </form> --}}
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-2">
                    <b>Applicants Results</b>
                </div>
                <div class="col-md-2">
                    <a href="/exportAppResults" class="btn btn-success btn-sm">Export</a>
                </div>
                <div class="col-md-4">
                {{-- <form action="/import_results" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" required>
                        <label class="custom-file-label" for="customFile">Select Excel File to Import</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="submit btn btn-primary btn-sm">Import</button>
                </div>
                </form> --}}
            </div>
        </li>
    </ul>
</div>

@endsection

