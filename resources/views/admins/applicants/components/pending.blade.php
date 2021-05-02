<div class="card mb-5">
    <div class="card-header">Pending Applicants</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="applicants table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width:10%">Photo</th>
                        <th scope="col" style="width:70%">Full Name</th>
                        <th scope="col" style="width:20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $item)
                    @if($item->appResult->status == "pending")
                    <tr>
                        <td>
                            <img src="data:image;base64,{{$item->user->photo}}" width="50" height="auto;"/>
                        </td>
                        <td>
                            <a href="/admins/applicants/edit/{{$item->id}}">
                                {{$item->first_name}} {{$item->last_name}}
                            </a>
                        </td>
                        <td>{{$item->appResult->status}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
