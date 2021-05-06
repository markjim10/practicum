<div class="table-responsive">
    <table id="examsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Start</th>
                <th scope="col">End</th>
                <th scope="col">Type</th>
                <th scope="col">Total Examinees</th>
                <th scope="col">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
            <tr>
                <td>{{$exam->id}}</td>
                <td><a href="/exams/{{$exam->id}}">{{$exam->exam_name}}</a></td>
                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('m/d/Y')}}</td>
                <td>{{ \Carbon\Carbon::parse($exam->exam_start)->format('g:i:s A')}}</td>
                <td>{{ \Carbon\Carbon::parse($exam->exam_end)->format('g:i:s A')}}</td>
                <td>{{$exam->exam_type}}</td>
                <td>{{$exam->total_examinees}}</td>
                <td>{{$exam->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $('#examsTable').DataTable({

    });
</script>
