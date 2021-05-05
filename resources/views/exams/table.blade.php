<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Exam Name</th>
                <th scope="col">Preview</th>
                <th scope="col">Updated At</th>
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
