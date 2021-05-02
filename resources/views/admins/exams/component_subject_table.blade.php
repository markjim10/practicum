<div class="card">
    <div class="card-header">Subjects</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="tblSubject table table-striped table-bordered ">
                <thead>
                    <tr>
                    <th scope="col" style="width: 40%">Subject</th>
                    <th scope="col">Questions</th>
                    <th scope="col">Status</th>
                    <th scope="col">Remove</th>
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

                        <td>
                        <button id="{{$item->id}}"
                            class="btnSubjectRemove btn btn-sm btn-danger">
                            Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(".btnSubjectRemove").click(function() {
    var remove = $(this);
    bootbox.confirm({
    message: "Are you sure you want to remove this Subject?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
            if(result) {
                remove.parent().parent().remove();
                data = { "id": remove.attr('id') }
                id = remove.attr('id');
                $.ajax({
                    type: "GET",
                    url:'/subject_remove/'+id+'',
                    data: data,
                    success: function (response) {
                        console.log(response);
                        // location.reload();
                    },
                });
            }
        }
    });
});
</script>

