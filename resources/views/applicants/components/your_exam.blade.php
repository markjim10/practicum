<p class="lead">
    Your examination is on
    {{$yourExam->exam_date}}
    {{ Carbon\Carbon::parse($yourExam->exam_start)->format('g:i A') }} -
    {{ Carbon\Carbon::parse($yourExam->exam_end)->format('g:i A') }}
</p>


