<!DOCTYPE html>
<html>
<head>
    <title>Exams Report</title>
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
    <h3>Reports for Results of Exams as of {{$date}}</h3>
    <hr>
    <table>
        <thead>
            <tr>
            <th>Subject</th>
            <th>Average</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($exams_results as $item)
            <tr>
                <td>{{$item->subject}} </td>
                <td>{{$item->average}} %</td>
            </tr>
        </tbody>
    @endforeach
</table>
</body>
</html>
