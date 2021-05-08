@extends('layouts.app')
@extends('layouts.sidebar')
@section('admin')

<div class="container-fluid mt-3">
    <h2>Trail Logs</h2>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Trail ID</th>
                    <th>Time</th>
                    <th>User</th>
                    <th>Trail Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trails as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('M d Y g:i A')}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->trail}}</td>
                    <td>{{$item->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
    $('table').DataTable({
    "autoWidth": false,
    "order": [[ 0, "desc" ]]
});
</script>

@endsection
