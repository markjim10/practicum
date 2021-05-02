@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<div class="container-fluid mt-3">
    <h2>Trail Logs</h2>
    <hr class="site_hr">
<div class="card">
    <div class="card-header">Trails List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%">Trail ID</th>
                        <th scope="col" style="width: 20%">Time</th>
                        <th scope="col" style="width: 20%">User</th>
                        <th scope="col" style="width: 50%">Trail Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trails as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('M d Y g:i A')}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->trail}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    $('table').DataTable({
    "autoWidth": false,
    "order": [[ 0, "desc" ]]
});
</script>

@endsection
