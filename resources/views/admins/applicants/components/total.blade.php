<div class="card mb-5">
    <div class="card-header">Total Applicants</div>
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
                    <tr>
                        <td>
                            <img class="" src="data:image;base64,{{$item->user->photo}}" width="50" height="auto;"/>
                        </td>
                        <td>
                        <a href="/admins/applicants/edit/{{$item->id}}">
                            {{$item->first_name }} {{$item->last_name}}
                        </a>
                        </td>

                        <td>
                        @if($item->appResult->status=="approved")
                        <span style="text-transform:capitalize; color:green;"><b>{{$item->appResult->status}}</b></span>
                        @elseif($item->appResult->status=="pending")
                        <span style="text-transform:capitalize; color:orange;"><b>{{$item->appResult->status}}</b></span>
                        @else
                        <span style="text-transform:capitalize; color:red;"><b>{{$item->appResult->status}}</b></span>
                        @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{-- {{ $app->links() }} --}}
        </div>
    </div>
</div>


