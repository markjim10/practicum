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

    </style>
</head>
<body>
    <h3>Passers as of {{$date}}</h3>
    <hr>
    <table>
        <thead>
            <tr>
            <th>Name</th>
            <th>Exam Score</th>
            <th>Date of Exam</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($passers as $item)
            <tr>
                <td>
                    {{$item->name}}
                </td>
                <td>{{$item->average}}</td>
                <td>{{$item->date}}</td>
            </tr>
        </tbody>
    @endforeach
</table>
</body>
</html>
