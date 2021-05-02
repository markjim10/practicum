<div class="card mb-5">
    <div class="card-header">Examinations</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 60%">Exam</th>
                        <th scope="col">Preview</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $item)
                    <tr>
                        <td>{{$item->exam_name}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                            href="/preview/{{$item->id}}">
                                Preview
                            </a>
                        </td>
                        <td>
                            <button id="{{$item->id}}"
                                class=" btn btn-danger btn-sm btnExamRemove">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(".btnExamRemove").click(function() {

    var remove = $(this);

    bootbox.confirm({
    message: "Are you sure you want to remove this Exam?",
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
                id = remove.attr('id');
                $.ajax({
                    type: "GET",
                    url:'/remove_exam/'+id+'',
                    success: function (response) {
                        console.log(response);
                    },
                });
            }
        }
    });
});

// var remove = document.querySelectorAll(".btnExamRemove");
// remove.onclick = (e) =>
// {
//     alert('gago');
// }


</script>
