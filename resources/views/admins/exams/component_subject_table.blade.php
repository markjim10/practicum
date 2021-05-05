<div class="card">
    <div class="card-header">Subjects</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Questions</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $item)
                    <tr>
                        <td>
                            <a href="/subject_show/{{$item->id}}"><b>{{$item->name}}</b></a>
                        </td>
                        <td>{{$item->num_questions}}</td>

                        @if($item->status == "approved")
                            <td style="font-weight:bold; color:green">{{$item->status}}</td>
                        @else
                        <td
                            style="font-weight:bold;
                            color:orange"
                            >{{$item->status}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
