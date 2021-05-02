<p>Your request is approved, please select a date for your entrance exam.</p>

<form action="/select_date" method="post">
    @csrf
    <div class="col-6">
        @csrf
        <div class="form-group">
        <select name="date_id" required
        class='form-control form-control-sm'>
            <option value="" selected disabled>Select Date</option>
            @foreach ($examdates as $item)
                {{-- @if(json_encode(Carbon\Carbon::now()->greaterThan($item->exam_end))=="false") --}}
                <option value="{{$item->id}}">
                {{$item->exam_date}} -
                {{ Carbon\Carbon::parse($item->exam_start)->format('g:i A') }} to
                {{ Carbon\Carbon::parse($item->exam_end)->format('g:i A') }}
                </option>
                {{-- @endif --}}
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" id="no-radius">Submit Date</button>
        </div>
    </div>
</form>
