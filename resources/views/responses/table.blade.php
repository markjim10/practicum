<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Responses</th>
            <th>Number of Words</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($responses as $response)
            <tr>
                <td>{{$response->id}}</td>
                <td>
                    <a class="" href="/responses/{{$response->id}}">
                    {{$response->response}}
                    </a>
                </td>
                <td>
                    {{$response->getWordCount()}}
                </td>
                <td>
                    {{$response->updated_at}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    $('table').DataTable({

    });
</script>
