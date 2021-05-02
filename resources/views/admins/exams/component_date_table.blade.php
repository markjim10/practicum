<div class="card mb-5">
    <div class="card-header">Upcoming Examination Schedules</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Exam Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    {{-- <th>Remove</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($dates as $item)
                    <tr>
                        <td>{{$item->exam_date}}</td>
                        <td>{{date('g:i A', strtotime($item->exam_start))}}</td>
                        <td>{{date('g:i A', strtotime($item->exam_end))}}</td>
                        {{-- <td>
                        <button id="{{$item->id}}" class="btnDateRemove btn btn-danger btn-sm">Remove</button>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>

$(".btnDateRemove").click(function() {

var remove = $(this);

bootbox.confirm({
message: "Are you sure you want to delete this Exam Schedule?",
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
        $.ajax({
            type: "GET",
            url:'/remove_exam_date/'+JSON.stringify(data)+'',
            data: data,
            success: function (response) {
                console.log(response);
            },
        });
    }
}
});






});
</script>
