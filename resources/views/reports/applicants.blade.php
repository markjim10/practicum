<!DOCTYPE html>
<html>
<head>
    <title>Preferred Courses Report</title>
<style>
    table, td, th {
        border: 1px solid black;
        text-align:center;
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }

      th {
        height: 50px;
      }
    </style>
</head>
<body>
    <h3>Reports for the Preferred Programs of Applicants as of {{$date}}</h3>
    <hr>
    <table>
        <thead>
            <tr>
            <th>Programs Preferred</th>
            <th>Count of Applicants</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($programs as $item)
            <tr>
                <td>
                    {{$item->program}}
                </td>
        <td>{{$item->count}}</td>
            </tr>
        </tbody>
    @endforeach
</table>
</body>
</html>
