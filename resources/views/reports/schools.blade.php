<!DOCTYPE html>
<html>
<head>
    <title>Schools Report</title>
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
    <h3>Reports for School passing rates as of {{$date}}</h3>
    <hr>
    <table>
        <thead>
            <tr>
            <th>School</th>
            <th>Total Examinees</th>
            <th>Total Passers</th>
            <th>Passing Rate</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($schools as $item)
            <tr>
                <td>{{$item->school}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->pass}}</td>
                <td>{{$item->passing}}%</td>
            </tr>
        </tbody>
    @endforeach
</table>
</body>
</html>
