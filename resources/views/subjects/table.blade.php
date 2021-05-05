<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Questions</th>
                <th>Status</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>
                    <a href="/subjects/{{$subject->id}}/edit">
                        {{$subject->subject_name}}
                    </a>
                    </td>
                    <td>{{$subject->num_questions}}</td>
                    @if($subject->status == "approved")
                        <td class="status" style="color:green">{{$subject->status}}</td>
                    @else
                        <td class="status" style="color:orange">{{$subject->status}}</td>
                    @endif
                    <td>{{$subject->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.table').DataTable({

    });
</script>
