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
            <th style="width: 80%">Programs Preferred</th>
            <th>Total Applicants</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($programs as $program)
            <tr>
                <td>
                    {{$program->program_name}}
                </td>
        <td>{{$program->count}}</td>
            </tr>
        </tbody>
    @endforeach
</table>
</body>
</html>
