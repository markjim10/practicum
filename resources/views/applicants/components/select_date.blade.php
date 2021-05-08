<p>Your request is approved, please select a date for your entrance exam.</p>
<form action="/select_date" method="post">
    @csrf
    <div class="row">

    <div class="col-6">
        @csrf
        <div class="form-group">
        <select name="date_id" required
        class='form-control form-control-sm'>
            <option value="" selected disabled>Select Date</option>
            @foreach ($exams as $exam)
                <option value="{{$exam->id}}">
                {{$exam->exam_date}} -
                {{ Carbon\Carbon::parse($exam->exam_start)->format('g:i A') }} to
                {{ Carbon\Carbon::parse($exam->exam_end)->format('g:i A') }}
                </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-md" id="no-radius">
                Submit Date
            </button>
        </div>
    </div>
</div>

</form>
