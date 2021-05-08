{{-- Your examination date is on <br><br>
<b style="color:#00214E;">
{{$yourExam->exam_date}}
{{ Carbon\Carbon::parse($yourExam->exam_start)->format('g:i A') }} -
{{ Carbon\Carbon::parse($yourExam->exam_end)->format('g:i A') }}
</b> --}}
